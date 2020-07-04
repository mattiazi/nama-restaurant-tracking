<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Restaurant;

class RestaurantController extends Controller
{

    public function __construct(){
        $this->middleware("auth", ["except" => ["login", "register"]]);
    }

    public function logout(){
        Auth::logout();

        return redirect()->route("login")->with([
            "status" => "success",
            "message" => "Logout effettuato"
        ]);
    }

    public function login(Request $request){
        $SALT_EMAIL_HASHED = env("SALT_EMAIL_HASHED");

        if($request->filled(["email", "password"])){
            try{
                $restaurant = Restaurant::where("email_hash", hash("sha256", $request->email.$SALT_EMAIL_HASHED))->firstOrFail();
            }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                return redirect()->route("login")->with([
                    "result" => "error",
                    "message" => "Login sbagliato. Riprova"
                ]);
            }

            if(Hash::check($request->password, $restaurant->password)){
                Auth::login($restaurant);
                if($this->isAdmin()){
                    return redirect()->route("admin-home");
                }else{
                    return redirect()->route("home");
                }
            }else{
                return redirect()->route("login")->with([
                    "status" => "error",
                    "message" => "Login sbagliato. Riprova"
                ]);
            }
        }else{
            return redirect()->route("login")->with([
                "status" => "error",
                "message" => "Devi compilare tutti i campi"
            ]);
        }
    }

    public function register(Request $request){
        if(!$request->filled(["nome_ristorante", "email", "password", "re_password"])){
            return redirect()->route("admin-home")->with([
                "status" => "error",
                "message" => "Compilare tutti i campi"
            ]);
        }

        $SALT_EMAIL_HASHED = env("SALT_EMAIL_HASHED");

        $restaurant = new Restaurant();

        $restaurant->nome_ristorante = $request->nome_ristorante;
        $restaurant->email = $request->email;

        if($request->password!=$request->re_password){
            return redirect()->route("admin-home")->with([
                "status" => "error",
                "message" => "Errore! Le password non corrispondono"
            ]);
        }

        $restaurant->password = Hash::make($request->password);
        $restaurant->email_hash = hash("sha256", $request->email.$SALT_EMAIL_HASHED);

        $restaurant->save();

        return redirect()->route("admin-home")->with([
            "status" => "success",
            "message" => "Ristorante creato"
        ]);
    }

    public function home(){
        $restaurant = Auth::user();

        $people = $restaurant
                ->people()
                ->orderBy("created_at", "desc")
                ->simplePaginate(20);

        return view("home", ["people" => $people]);
    }

    public function editProfile(Request $request){
        if(!$request->filled(["old_password", "password", "re_password"])){
            return redirect()->route("profile-home")->with([
                "status" => "error",
                "message" => "Compilare tutti i campi"
            ]);
        }

        $restaurant = Auth::user();

        if($request->password!=$request->re_password){
            return redirect()->route("profile-home")->with([
                "status" => "error",
                "message" => "Errore! Le password non corrispondono"
            ]);
        }

        if(!Hash::check($request->old_password, $restaurant->password)){
            return redirect()->route("profile-home")->with([
                "status" => "error",
                "message" => "La password vecchia non è corretta"
            ]);
        }

        $restaurant->password = Hash::make($request->password);

        $restaurant->save();

        return redirect()->route("profile-home")->with([
            "status" => "success",
            "message" => "Password aggiornata"
        ]);
    }

    /**
     * ADMIN
     */

    public function isAdmin(){
        $restaurant = Auth::user();

        if($restaurant->ruolo=="ADMIN"){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}

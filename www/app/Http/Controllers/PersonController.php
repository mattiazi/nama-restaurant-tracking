<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Person;

class PersonController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function insert(Request $request){

        $person = new Person();

        if($request->filled(["nome", "cognome", "telefono"])){    
            $person->nome = $request->nome;
            $person->cognome = $request->cognome;
            $person->telefono = $request->telefono;
            $person->restaurant_id = Auth::id();

            $person->save();

            return redirect()->route("home")->with([
                "status" => "success",
                "message" => "Record inserito"
            ]);
        }else{
            return redirect()->route("home")->with([
                "status" => "error",
                "message" => "Inserire tutti i dati!"
            ]);
        }
    }

    public function delete($id){

        try{
            $person = Person::findOrFail($id);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return redirect()->route("home")->with([
                "result" => "error",
                "message" => "Persona non trovata, impossibile eliminare"
            ]);
        }

        if($person->restaurant_id==Auth::id()){
            $person->delete();

            return redirect()->route("home")->with([
                "status" => "success",
                "message" => "Record eliminato"
            ]);
        }else{
            return redirect()->route("home")->with([
                "status" => "error",
                "message" => "Impossibile eliminare il record selezionato"
            ]);
        }
        
    }

}

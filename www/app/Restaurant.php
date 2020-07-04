<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{

    use SoftDeletes;

    protected $guarded = ['id'];
    
    protected $hidden = [
        'password',
    ];

    protected $attributes = [
        "ruolo" => "RESTAURANT",
    ];


    /**
     * ATTRIBUTES
     */

    public function setNomeRistoranteAttribute($value){
        $this->attributes["nome_ristorante"] = encrypt($value);
    }

    public function getNomeRistoranteAttribute(){
        return decrypt($this->attributes["nome_ristorante"]);
    }

    public function setEmailAttribute($value){
        $this->attributes["email"] = encrypt($value);
    }

    public function getEmailAttribute(){
        return decrypt($this->attributes["email"]);
    }

    /**
     * RELATIONSHIPS
     */

    public function people(){
        return $this->hasMany("App\Person");
    }
    
}

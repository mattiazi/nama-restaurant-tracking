<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{

    use SoftDeletes;
    
    public function setNomeAttribute($value){
        $this->attributes["nome"] = encrypt($value);
    }

    public function getNomeAttribute(){
        return decrypt($this->attributes["nome"]);
    }

    public function setCognomeAttribute($value){
        $this->attributes["cognome"] = encrypt($value);
    }

    public function getCognomeAttribute(){
        return decrypt($this->attributes["cognome"]);
    }

    public function setTelefonoAttribute($value){
        $this->attributes["telefono"] = encrypt($value);
    }

    public function getTelefonoAttribute(){
        return decrypt($this->attributes["telefono"]);
    }
    
}

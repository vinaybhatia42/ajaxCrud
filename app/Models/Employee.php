<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $table="employees";
    public $timestamps=false;
    public function setEmailAttribute($value){
        $this->attributes['email'] = ucfirst($value);
    }
    public function getNameAttribute($value){
       return ucfirst($value);
    }
    public function getemailAttribute($value){
        return ucfirst($value);
     }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
//use Translatable;
    protected $table = 'slide';
    //public $translatedAttributes = [];
    protected $fillable = ['link','image'];
    public function getAll(){
        return $this->all();
    }
}

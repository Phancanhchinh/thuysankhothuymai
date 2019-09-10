<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //use Translatable;

    protected $table = 'news';
    //public $translatedAttributes = [];
    protected $fillable = ['title','content','image','create_at','update_at'];
}

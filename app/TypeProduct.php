<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class TypeProduct extends Model
{
    protected $table = 'type_products';
    protected $fillable = ['name','slug','description','created_at','updated_at'];
    public function product()
    {
        return $this->hasMany('App\Product', 'id_type', 'id');   //   1 loai san pham co nhieu san pham
    }
}

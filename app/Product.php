<?php

namespace App;
use Image;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','slug','id_type','description','unit_price','promotion_price','image','unit','new','created_at','updated_at'];
    public function type_product()
    {
        return $this->belongsTo('App\TypeProduct', 'id_type', 'id');
    }
    public function bill_detail()
    {
        return $this->hasMany('App\BillDetail', 'id_product', 'id');
    }
    public function uploadImage($request)
    {
        $nameImage = str_random(10).".". explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        $image = Image::make($request->image)->save(public_path('main/image/product/').$nameImage);
        return $nameImage;
    }
}

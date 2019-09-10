<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BillDetail extends Model
{
    protected $table = 'bill_detail';
    protected $fillable = ['id_bill','id_product','quantity','unit_price','created_at','updated_at'];
    public function product()
    {
        return $this->belongsTo('App\Product', 'id_product', 'id');
    }
    public function bill()
    {
        return $this->belongsTo('App\BillDetail', 'id_bill', 'id');
    }
}


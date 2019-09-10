<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = ['id','name','gender','email','address','phone_number','note','created_at','updated_at'];
    public function bills()
    {
        return $this->hasMany('App\Bill', 'id_customer', 'id');
    }

}

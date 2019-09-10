<?php

namespace App;
use Cart;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    public function getItemCart($product,$id)
    {
        $price = 0;
        if($product->promotion_price == null){
            $price = $product->unit_price;
        }else{
            $price = $product->promotion_price;
        }
        $cart = Cart::add(['id' => $id, 'name' => $product->name, 'qty' => 1, 'price' => $price, 'options' => [$product]]);
    }
    public function getDeleteCart($rowId)
    {
        Cart::remove($rowId);
    }
    public function getDeleteCartAll()
    {
        Cart::destroy();
    }
    public function getUpdateCart($id,$sl)
    {
        Cart::update($id,$sl);
    }
    public function getDestroyCart()
    {
        Cart::destroy();
    }

}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Cart;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\SendMail;
use Illuminate\Mail\Mailable;
use App\Bill;
use App\BillDetail;
use App\Customer;
use App\ShoppingCart;
use Datetime;
use App\Http\Requests\CheckoutRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Bill\BillRepositoryInterface;
use App\Repositories\BillDetail\BillDetailRepositoryInterface;
class CartController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository,BillDetailRepositoryInterface $billdetailRepository,BillRepositoryInterface $billRepository,CustomerRepositoryInterface $customerRepository,ShoppingCart $shoppingcart,SendMail $sendMail){
        $this->sendMail = $sendMail;
        $this->shoppingcart = $shoppingcart;
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
        $this->billdetailRepository = $billdetailRepository;
        $this->billRepository = $billRepository;
    }
    public function getCart($id){
        $product = $this->productRepository->getId($id);
        $this->shoppingcart->getItemCart($product,$id);
        return  redirect('/');
    }
    public function getDeleteItem($rowId){
        $this->shoppingcart->getDeleteCart($rowId);
        return  redirect('/');
    }
    public function getDeleteAll(){
        $this->shoppingcart->getDeleteCartAll();
        return  redirect('/');
    }
    public function getCheckOut(Request $request){
        $user = Auth::user();
        return view('mid.pages.order',compact('user'));
    }
    public function getUpdateCart(Request $request){
        $id = $request->id;
        $sl = $request->sl;
        $this->shoppingcart->getUpdateCart($id,$sl);
        return  redirect('pay');
    }
    public function postCheckOut(CheckoutRequest $req)
    {
        $customer = $this->customerRepository->getCreate($req->all());
        $bill = $this->billRepository->getCreate(['id_customer' => $customer->id,'date_order' => new Datetime(),'total' => Cart::subtotal(0,",","."),'payment' => $req->payment_method,'note' =>$req->note, 'status' => 0]);
        $cart_item = Session('cart');
        foreach($cart_item['default'] as $key => $data)
        {
            $bill_detail = $this->billdetailRepository->getCreate(['id_bill'=>$bill->id,'id_product' => $data->id,'quantity' => $data->qty,'unit_price' =>$data->price]);
        }
        $this->sendMail->sendMailOrder($req->email,$req->name,$req->address,$req->note,$req->phone_number,$cart_item);
        $this->shoppingcart->getDestroyCart();
        return redirect('pages-200')->with('msg','Cảm ơn '.$req->txtName.' đã mua hàng vui lòng kiểm tra lại email để xem đơn hàng chi tiết');
    }
}

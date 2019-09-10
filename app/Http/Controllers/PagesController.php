<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Product;
use App\Slide;
use App\TypeProduct;
use App\User;
use DB;
use Datetime;
use App\SendMail;
use Illuminate\Mail\Mailable;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\TypeProduct\TypeProductRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class PagesController extends Controller
{
    public function __construct(Slide $slide,SendMail $sendMail,ProductRepositoryInterface $productRepository,TypeProductRepositoryInterface $typeProductRepository,UserRepositoryInterface $userRepository)
    {
        $this->slide = $slide;
        $this->productRepository = $productRepository;
        $this->typeProductRepository = $typeProductRepository;
        $this->userRepository = $userRepository;
        $this->sendMail = $sendMail;
    }
    public function getIndex()
    {

        $slide = $this->slide->getAll();
        $new_product  = $this->productRepository->getWherePaginate('new','=',1,8);
        $sale_product = $this->productRepository->getWherePaginate('promotion_price','<>',0,8);
        return view('mid.pages.index',compact('slide','new_product','sale_product'));
    }
    public function getContact()
    {
        return view('mid.pages.contact');
    }
    public function getAbout()
    {
        return view('mid.pages.introduce');
    }
    public function getDetail(Request $req)
    {
        $id = $req->id;
        $lang = $req->locale;
        $one_product = Product::find($id);
        $product_all = Product::all();
        $product_relate = Product::where('id_type',$one_product->id_type)->where('id','<>',$id)->paginate(3);
        $seller = DB::table('bill_detail')->select(DB::raw('count(id_product) as sosanpham, id_product'))
        ->orderBy('sosanpham','desc')->groupBy('id_product')->take(5)->get();
        $id_product1 = $seller[0]->id_product;
        $id_product2 = $seller[1]->id_product;
        $id_product3 = $seller[2]->id_product;
        $id_product4 = $seller[3]->id_product;
        $product_seller1 = Product::find($id_product1);
        $product_seller2 = Product::find($id_product2);
        $product_seller3 = Product::find($id_product3);
        $product_seller4 = Product::find($id_product4);
        $array_product = [$product_seller1,$product_seller2,$product_seller3,$product_seller4];
        $new_p = Product::where('new',1)->where('id','<>',$id)->get()->take(6);
        return view('mid.pages.detail_product',compact('one_product','product_relate','seller','product_all','array_product','new_p'));
    }
    public function getProduct()
    {
        $all_product = $this->productRepository->getPaginate(6);
        return view('mid.pages.product',compact('all_product'));
    }
    public function getTypeProduct(Request $req)
    {
        $detail_type_product = $this->typeProductRepository->getId($req->id);
        $all_product_by_type = $this->productRepository->getWherePaginate('id_type','=',$req->id,6);
        return view('mid.pages.type_product',compact('detail_type_product','all_product_by_type'));
    }
    public function getThanks()
    {
        return view('mid.pages.200');
    }
    public function getRegister()
    {
        return view('mid.pages.register');
    }
    public function getSearch(Request $req)
    {
        $search_product = $this->productRepository->getSearch($req->search,'name','description',6);
        return view('mid.pages.find', compact('search_product'));
    }
    public function postRegister(RegisterRequest $req)
    {
        $pass = $req->password;
        $req['password'] =  Hash::make($req->password);
        $req['role'] =  0;
        $this->userRepository->getCreate($req->all());
        $this->sendMail->sendMailRegister($req->full_name,$req->email,$pass);
        return redirect('pages-200')->with('msg','Cảm ơn '.$req->full_name.' đã đăng ký. Bây giờ bạn đã có thể đăng nhập');
    }

    public function getLogin()
    {
        return view('mid.pages.login');
    }
    public function postLogin(Request $req)
    {
        $login_check = array('email' => $req->txtEmail,'password' => $req->txtPass);
        if(Auth::attempt($login_check))
        {
            return redirect('/');
        }else{
            return redirect('dang-nhap');
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}

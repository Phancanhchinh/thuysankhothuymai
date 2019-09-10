<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
use App\Product;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Bill\BillRepository;
use App\Repositories\Bill\BillRepositoryInterface;
use App\Repositories\BillDetail\BillDetailRepository;
use App\Repositories\BillDetail\BillDetailRepositoryInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\TypeProduct\TypeProductRepository;
use App\Repositories\TypeProduct\TypeProductRepositoryInterface;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(BillRepositoryInterface::class,BillRepository::class);
        $this->app->bind(BillDetailRepositoryInterface::class,BillDetailRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class,CustomerRepository::class);
        $this->app->bind(TypeProductRepositoryInterface::class,TypeProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $req)
    {
        $type_product = TypeProduct::all();
        $id_type = $req->id;
        $detail_type_product = TypeProduct::find($id_type);
        $all_product_by_type = Product::where('id_type',$id_type)->paginate(6);
        view()->share(['type_product' => $type_product, 'all_product_by_type' => $all_product_by_type]);
        view()->composer(['mid.layout.header','mid.pages.order'], function ($view) {
            if(Session::has('cart'))
            {
                $total = Cart::subtotal(0,",",".");
                $count = Cart::content()->count();
                $view->with(['cart' => Session::get('cart'),'totalPrice' => $total,'countItem' => $count]);
            }
        });
    }
}

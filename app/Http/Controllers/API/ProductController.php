<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Image;
use Validator;
use App\Http\Requests\ProductRequest;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository,Product $product)
    {
        $this->productRepository = $productRepository;
        $this->product = $product;
    }
    public function index()
    {
        return $this->productRepository->getPaginate(5);
    }
    public function store(ProductRequest $request)   //create
    {
        $nameImage = $this->product->uploadImage($request);
        $request['created_at'] = date('Y-m-d H:i:s');
        $request['image'] = $nameImage;
        $request['new'] = 1;
        $request['slug'] = Str::slug($request->name,'-');
        $this->productRepository->getCreate($request->all());
    }
    public function searchProduct(Request $request)
    {
        if($request['q'] == null)
        {
            return $this->productRepository->getPaginate(5);
        }else{
            $search = $request['q'];
            return $this->productRepository->getSearch($search,'name','description',20);
        }
    }
    public function updateProduct(ProductRequest $request)
    {
        $request['slug'] = Str::slug($request->name,'-');
        $this->productRepository->getUpdate($request->id,$request->all());
    }
    public function deleteProduct(Request $request)
    {
        $this->productRepository->getDelete($request->id);
    }
}

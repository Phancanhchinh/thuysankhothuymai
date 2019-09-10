<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bill;
use App\BillDetail;
use App\Product;
use App\Customer;
use App\Repositories\Bill\BillRepositoryInterface;
use App\Repositories\BillDetail\BillDetailRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
class OrderController extends Controller
{
    public function __construct(BillRepositoryInterface $billRepository,BillDetailRepositoryInterface $billdetailRepository,CustomerRepositoryInterface $customerRepository,ProductRepositoryInterface $productRepository)
    {
        $this->billRepository = $billRepository;
        $this->billdetailRepository = $billdetailRepository;
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
    }
    public function index()
    {
        return $this->customerRepository->getPaginate(10);
    }
    public function show($id)
    {
        $bill = $this->billRepository->getIdSingle('id_customer','=',$id);
        $bill_detail = $this->billdetailRepository->getIdAll('id_bill','=',$bill->id);
        $product = $this->productRepository->getAll();
        return [$bill_detail,$bill,$product];
    }
    public function updateOrder(Request $request)
    {
        $request['status'] = 1;
        $this->billRepository->getUpdate($request->id,$request->all());
    }
    public function deleteOrder(Request $request)
    {
        $this->customerRepository->getDelete($request->id);
    }

    public function searchOrder(Request $request)
    {
        if($request['q'] == null)
        {
            return $this->customerRepository->getPaginate(5);
        }else{
            $search = $request['q'];
            return $this->customerRepository->getSearch($search,'name','email',5);
        }
    }
}

<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UsersRequest;
class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository,User $user)   //get
    {
        $this->userRepository = $userRepository;
        $this->user = $user;
    }
    public function index()
    {
        $user = $this->userRepository->getPaginate(10);
        return $user;
    }
    public function store(UsersRequest $request)     //post
    {
        $request['password'] = Hash::make($request->password);
        $createUser = $this->userRepository->getCreate($request->all());
    }
    public function profile()
    {
        return auth('api')->user();
    }
    public function updateProfile(UsersRequest $request)
    {
        $user = auth('api')->user();
        $this->user->editProfile($user,$request);
        $this->userRepository->getUpdate($user->id,$request->all());
    }

    public function searchUser(Request $request)
    {
        if($request['q'] == null)
        {
            return $this->userRepository->getPaginate(5);
        }else{
            $search = $request['q'];
            return $this->userRepository->getSearch($search,'full_name','email',10);
        }
    }
    public function updateUser(UsersRequest $request)
    {
        $user = $this->userRepository->getUpdate($request->id,$request->all());
    }

    public function deleteUser(Request $request)
    {
        $user = $this->userRepository->getDelete($request->id);
    }
}


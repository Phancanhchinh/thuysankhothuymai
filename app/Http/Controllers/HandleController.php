<?php

namespace App\Http\Controllers;
use Socialite;
use App\User;
use Illuminate\Http\Request;

class HandleController extends Controller
{
    public function loginFacebook($social){
        return Socialite::driver($social)->redirect();
    }
    public function handleFacebook(){
        $user = Socialite::driver($social)->user();
        $authUser = $this->findOrCreate($user);
        Auth::login($authUser);
        return redirect('/');
    }
    public function findOrCreate($data){
        $authUser = User::where('socia_id',$data->socia_id)->first();
        if($authUser){
            return $authUser;
        }else{
            return User::create([
                'full_name' => $data->name,
                'email' => $data->email,
                'password' => '',
                'address' => '',
                'phone' => '',
                'role' => 0,
                'photo' => '',
            ]);
        }
    }
}

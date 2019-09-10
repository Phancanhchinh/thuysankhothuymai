<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;   //  import in web laravel  // 2
use Image;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'full_name', 'email', 'password','phone','address','role','photo'
    ];
    public function editProfile($user,$request)
    {
        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto){        // hình mới ko giống hình hiện tại
            $name = str_random(10).".". explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];  // random lay dinh dang cua hinh`
            $img = Image::make($request->photo)->save(public_path('admin/img/profile/').$name);
            $user->photo = $name;
            $profilePhoto = public_path('admin/img/profile/').$currentPhoto;  // kiểm tra tồn tại nếu có thì xóa
            if(file_exists($profilePhoto)){
                @unlink($profilePhoto);
            }
        }
    }
}

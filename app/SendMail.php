<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Mail;
class SendMail extends Model
{
    public function sendMailOrder($email,$name,$adress,$note,$phone,$cart)
    {
        $data1 = array('name' => $name, 'adress' => $adress, 'note' => $note, 'phone' => $phone,'cart' => $cart);
        Mail::send('mid.pages.mailOrder',$data1, function ($message) use($email,$name) {
            $message->from('1551010013chinh@ou.edu.vn', 'Thủy Sản Khô Thùy Mai');
            $message->to($email,$name);
            $message->subject('Xác Nhận Đơn Hàng');
        });
    }
    public function sendMailRegister($name,$email,$pass)
    {
        $data2 = array('name' => $name,'email' => $email,'pass' => $pass);
        Mail::send('mid.pages.mailRegister',$data2, function ($message) use($email,$name) {
            $message->from('1551010013chinh@ou.edu.vn', 'Thủy Sản Khô Thùy Mai');
            $message->to($email,$name);
            $message->subject('Xác Nhận Đăng Ký');
        });
    }
}

<?php namespace App\Controller;


use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{

    public function register()
    {
        if (!request()->isPost())
            return;

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'confirm:password'
        ];

        if (!$this->validation(request()->all(), $rules)) {
            return;
        }

        $user = new User();
        $success = $user->create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => password_hash(request('password'), PASSWORD_BCRYPT, ['const' => 12]),
            'created_at' => Carbon::now()
        ]);

        if ($success) {

        }
        $this->flash->success("عضویت شما با موفقیت انجام شد");
        redirect("index.php");
    }

}
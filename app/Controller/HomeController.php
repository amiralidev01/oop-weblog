<?php namespace App\Controller;


use App\Models\DB;
use App\Models\User;

class HomeController
{
    public function index()
    {
        $user = new User();
        var_dump($user->select('name', 'email')->first());
        die;
    }
}
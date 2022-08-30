<?php namespace App\Helpers;

use App\Contracts\RequestInterface;

class Request implements RequestInterface
{

    public function input($field, $post = true)
    {
        if ($this->isPost() && $post)
            return isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : null;
        return isset($_GET[$field]) ? htmlspecialchars($_GET[$field]) : null;
    }

    public function all($post = true)
    {
        if ($this->isPost() && $post)
            return isset($_POST) ? array_map('htmlspecialchars', $_POST) : null;
        return isset($_GET) ? array_map('htmlspecialchars', $_GET) : null;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

}

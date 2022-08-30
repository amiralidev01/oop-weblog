<?php namespace App\Contracts;

interface RequestInterface
{
    /**
     * @param $field
     * @param $post
     * @return mixed
     */
    public function input($field, $post = true);

    /**
     * @param $post
     * @return mixed
     */
    public function all($post = true);

    /**
     * @return mixed
     */
    public function isPost();
}

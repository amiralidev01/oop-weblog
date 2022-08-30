<?php

function old($field)
{
    return request($field);
}

function request($field = null)
{
    $request = new \App\Helpers\Request();
    if (is_null($field))
        return $request;
    return $request->input($field);
}

function redirect($param)
{
    if (is_null($param))
        return $param = "/";
    header("Location: " . $param);
    exit();
}
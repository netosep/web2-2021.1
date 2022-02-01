<?php

namespace App\Validate;

class LoginValidate 
{

    public static function hasSession()
    {
        return session()->has('user');
    }

}
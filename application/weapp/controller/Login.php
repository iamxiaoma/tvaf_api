<?php
namespace app\weapp\controller;

class Login{

    public function __construct(){
    }

    public function login(){
        return result(app('loginService')->weapp(input('code')));
    }

}
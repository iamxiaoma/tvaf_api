<?php
namespace app\weapp\controller;

class Index
{
    public function index()
    {
        return 'tvaf weapp';
    }


    public function middleware(){
        echo 'tvaf weapp middleware';
    }
}

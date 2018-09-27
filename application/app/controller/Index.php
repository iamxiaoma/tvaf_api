<?php
namespace app\app\controller;

class Index
{
    public function index()
    {
        return 'tvaf app';
    }

    public function middleware(){
        echo 'tvaf app middleware';
    }
}

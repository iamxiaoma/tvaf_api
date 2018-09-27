<?php
namespace app\www\controller;

class Index
{
    public function index()
    {
        return 'tvaf www';
    }


    public function middleware(){
        echo 'tvaf www middleware';
    }
}

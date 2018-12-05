<?php
namespace app\test\controller;
use think\Db;

class Index
{
    public function index()
    {
        $girls = Db::table('girl')->select();

        return result($girls);
    }
}

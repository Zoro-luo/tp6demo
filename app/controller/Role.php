<?php

namespace app\controller;

use think\facade\Db;
use think\facade\View;

class Role
{
    public function index()
    {
        $role = Db::name('role')->select();
        return View::engine('php')->fetch('./view/role/index.php',[
            'num'   =>  10,
            'admin' =>  session('admin'),
            'list'  =>  $role
        ]);
    }
}
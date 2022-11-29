<?php

namespace app\controller;

use think\facade\Validate;
use think\facade\View;
use think\Request;

class Login
{
    private  $toast = 'public/toast';

    public function index()
    {
        return View::fetch('index');
    }

    public function check(Request $request)
    {
        $data = $request->param();
        //错误集合
        $errors = [];

        //验证用户名或密码
        $validate = Validate::rule([
            'name|用户名' => 'unique:auth,name^password',
        ]);
        $result = $validate->batch(true)->check([
            'name' => $data['name'],
            'password' => sha1($data['password'])
        ]);
        if(!captcha_check($data['code'])) {
            $errors[] = '验证码不正确~';
        }

        //错误提示
        if ($result) {
            $errors[] = '用户名或密码不正确~';
        }
        if (!empty($errors)) {
            return view($this->toast, [
                'infos' => $errors,
                'url_text' => '返回登录',
                'url_path' =>  url('/login')
            ]);
        } else {
            session('admin', $data['name']);
            return redirect('/');
        }
    }

    public function out()
    {
        session('admin', null);
        return redirect('/login');
    }

}
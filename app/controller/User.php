<?php
declare (strict_types=1);

namespace app\controller;

use think\exception\ValidateException;
use think\facade\View;
use think\Request;
use app\model\User as UserModel;
use app\validate\User as UserValidate;
use app\middleware\Auth as AuthMiddleware;

class User
{
    protected $middleware = [AuthMiddleware::class];
    private  $toast = 'public/toast';

    /**
     * 显示资源列表
     *
     * @return string
     */
    public function index()
    {
        return View::fetch('index', [
            'list' => UserModel::withSearch(['gender', 'username', 'email', 'create_time'], [
                'gender' => request()->param('gender'),
                'username' => request()->param('username'),
                'email' => request()->param('email'),
                'create_time' => request()->param('create_time'),
            ])->paginate([
                'list_rows' => 5,
                'query' => request()->param(),
            ]),
            'orderTime'         =>  request()->param('create_time') == 'desc' ? 'asc' : 'desc'
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return string
     */
    public function create()
    {
        return View::fetch('create');
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return string
     */
    public function save(Request $request)
    {
        //dd($request->param());
        $data = $request->param();
        try {
            validate(UserValidate::class)->batch(true)->check($data);
        } catch (ValidateException $exception) {
            return View::fetch($this->toast, [
                'infos' => $exception->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/user/create'),
            ]);
        }
        //密码加密
        $data['password'] = sha1($data['password']);

        //写入数据库
        $id = UserModel::create($data)->getData('id');

        //写入关联hobby
        $user = UserModel::find($id);
        $id = $user->hobby()->save(['content'=>$data['content']]);

        return $id ? View::fetch($this->toast, [
            'infos' => ['恭喜，注册成功！'],
            'url_text' => '去首页',
            'url_path' => url('/'),
        ]) : '注册失败!';
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        return view('read',[
            'obj'   =>  UserModel::find($id),
        ]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return string
     */
    public function edit($id)
    {
        //
        return View::fetch('edit', [
            'obj' => UserModel::find($id),
        ]);

    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        $data = $request->param();
        try {
            validate(UserValidate::class)->scene('edit')->batch(true)->check($data);
        } catch (ValidateException $exception) {
            return View::fetch($this->toast, [
                'infos' => $exception->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/user/' . $id . 'edit'),
            ]);
        }

        //有密码 则写入
        if (!empty($data['newpasswordnot'])) {
            $data['password'] = sha1($data['newpasswordnot']);
        }

        $user = UserModel::find($id);
        //关联修改hobby数据 如果有数据则修改 没有则新增
        if ($user->hobby){
            $res = $user->hobby->save(['content'=>$data['content']]);
        }else{
            $res = $user->hobby()->save(['content'=>$data['content']]);
        }

        return $res ? View::fetch($this->toast, [
            'infos' => ['恭喜，修改成功~'],
            'url_text' => '去首页',
            'url_path' => url('/')
        ]) : '修改失败';
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return string
     */
    public function delete($id)
    {
        //删除user表同时关联删除附表hobby 的数据
        $user =  UserModel::with('hobby')->find($id);
        $result = $user->together(['hobby'])->delete();

        return $result ? View::fetch($this->toast, [
            'infos' => ['恭喜，删除成功！'],
            'url_text' => '去首页',
            'url_path' => url('/'),
        ]) : "删除失败";
    }
}

<?php
declare (strict_types=1);

namespace app\controller;

use app\model\Auth as AuthModel;
use app\model\User as UserModel;
use think\facade\View;
use think\Request;
use app\model\Role as RoleModel;
use app\model\Access as AccessModel;
use app\middleware\Auth as AuthMiddleware;

class Auth
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
        $list = AuthModel::with(['role'])-> withSearch(['name'], [
            'name' => request()->param('name'),
        ])->paginate([
            'list_rows' => 5,
            'query' => request()->param(),
        ]);

        foreach ($list as $key=>$obj){
            foreach ($obj->role as $r){
                $obj->roles  .=  $r->type.' | ';
            }
            $obj->roles = substr(trim($obj->roles),0,-2);
        }
        return View::fetch('index',[
            'list'  =>  $list,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $list = RoleModel::select();
        return  view('create',['list'=>$list]);
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return
     */
    public function save(Request $request)
    {
        $data = $request->param();
        $data['password'] = sha1($data['password']);
        //写入Auth表
        $id = AuthModel::create($data)->getData('id');
        //关联保存
        AuthModel::find($id)->role()->saveAll($data['role']);
        return $id ? view($this->toast,[
            'infos' => ['恭喜，添加成功！'],
            'url_text' => '去管理首页',
            'url_path' => url('/auth'),
        ]) : "添加失败";
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return
     */
    public function edit($id)
    {
        return View::fetch('edit',[
            'auth'=>AuthModel::find($id),
            'role'=>RoleModel::select(),
        ]);
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return
     */
    public function update(Request $request, $id)
    {
        $data = $request->param();
        if (!empty($data['password'])){
            $data['password'] = sha1($data['password']);
        }
        $res = AuthModel::update($data);
        foreach ($data['role'] as $roleId){
          AccessModel::find($id)->save(['role_id'=>$roleId]);
        }
        return $res ? view($this->toast,[
            'infos' => ['恭喜，update成功！'],
            'url_text' => '去管理首页',
            'url_path' => url('/auth'),
        ]) : "update失败";


    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return
     */
    public function delete($id)
    {
        $line =  AuthModel::find($id)->delete();

        if ($line){
            AccessModel::where('auth_id',$id)->delete();
        }

        return View::fetch($this->toast, [
            'infos' => ['恭喜，删除成功！'],
            'url_text' => '去列表页',
            'url_path' => url('/auth'),
        ]) ;

    }
}

<?php
declare (strict_types=1);

namespace app\controller;

use think\facade\View;
use think\Request;
use app\model\Hobby as HobbyModel;

class Hobby
{

    private  $toast = 'public/toast';
    /**
     * 显示资源列表
     *
     * @return
     */
    public function index()
    {
        $list = HobbyModel::with('user')->withSearch([ 'content'], [
            'content' => request()->param('content'),
        ])->paginate([
            'list_rows' => 5,
            'query' => request()->param(),
        ]);
        return view('index', ['list' => $list]);
    }

    /**
     * TODU 不做新增
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * TODU 不做新增
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * TUDO: 不做单条显示
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
        $hobby = HobbyModel::find($id);

        return View::fetch('edit',[
            'obj'   =>  $hobby
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
        $hobby = HobbyModel::find($id);
        $result = $hobby->save(['content'=>$data['content']]);

        return $result ? View::fetch($this->toast,[
            'infos' => ['恭喜，修改成功~'],
            'url_text' => '去列表页',
            'url_path' => url('/hobby')
        ]) : '更新失败';
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return
     */
    public function delete($id)
    {
        $hobby = HobbyModel::destroy($id);
        return  $hobby ? View::fetch($this->toast,[
            'infos' => ['恭喜，删除成功~'],
            'url_text' => '去列表页',
            'url_path' => url('/hobby')
        ]) : '删除失败';
    }
}

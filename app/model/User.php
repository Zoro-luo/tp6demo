<?php

namespace app\model;

use think\Model;

class User extends Model
{
    //一对一 hooby
    public function hobby()
    {
        return  $this->hasOne(Hobby::class,'user_id','id');
    }

    //gender 搜索器
    public function searchGenderAttr($query, $value)
    {
        return $value ? $query->where('gender', $value) : '';
    }

    //username 搜索器
    public function searchUsernameAttr($query, $value)
    {
        return $value ? $query->where('username', 'like', '%' . $value . '%') : '';
    }

    //email 搜索器
    public function searchEmailAttr($query, $value)
    {
        return $value ? $query->where('email', 'like', '%' . $value . '%') : '';
    }

    //create_time 搜索器
    public function searchCreateTimeAttr($query, $value)
    {
        return $value ? $query->order('create_time', $value) : '';
    }

    //status 获取器
    public function getStatusAttr($value)
    {
        $status = [0 => '待审核', 1 => '通过'];
        return $status[$value];
    }

    //status 按钮背景获取器(虚拟字段)
    public function getBadgeAttr($value, $data)
    {
        return $data['status'] ? 'success' : 'warning';
    }
}
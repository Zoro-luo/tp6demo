<?php

namespace app\model;

use think\Model;

class Hobby extends Model
{
    //反向 一对一 user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //username 搜索器
    public function searchContentAttr($query, $value)
    {
        return $value ? $query->where('content', 'like', '%' . $value . '%') : '';
    }
}
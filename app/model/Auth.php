<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Auth extends Model
{
    //多对多
    public function role()
    {
        return $this->belongsToMany(Role::class,Access::class,'role_id','auth_id');
    }

    //name 搜索器
    public function searchNameAttr($query, $value)
    {
        return $value ? $query->where('name', 'like', '%' . $value . '%') : '';
    }
}

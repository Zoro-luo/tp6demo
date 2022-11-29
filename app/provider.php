<?php
use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,

    //自定义分页指向
    'think\Paginator' => 'app\common\Bootstrap',
];

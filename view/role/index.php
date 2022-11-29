<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TP6Demo -- 角色列表1</title>
    <!-- 引入 Bootstrap CSS -->
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/style.css">

    <!-- 移动设备优先 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<!--导航-->
<nav class="navbar navbar-light bg-light shadow-sm p-1">
    <a href="#"></a>
    <div class="nav-item dropdown mr-5">
        <a href="#" class="dropdown-toggle nav-link text-secondary" data-toggle="dropdown"><?=$admin?></a>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item">个人中心</a>
            <a href="/logout" class="dropdown-item">退出管理</a>
        </div>
    </div>
</nav>
<!--核心部分-->
<div class="container pt-5 mt-5">
    <div class="row align-items-center">
        <div class="col-3 siadebar">
            <button class="btn btn-secondary user">用户管理</button>
            <button class="btn btn-secondary hobby">喜好管理</button>
            <button class="btn btn-secondary repeat">书籍管理</button>
            <button class="btn btn-secondary role">角色管理</button>
            <button class="btn btn-secondary auth">权限管理</button>
        </div>
        <div class="col-9 main">
            <!--数据列表-->
            <table class="table table-bordered">
                <thead class="bg-light">
                <tr>
                    <th class="text-center">ID</th>
                    <th>角色名</th>
                    <th>模块地址</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $obj) {?>
                    <tr>
                        <td class="text-center"><?=$obj['id']?></td>
                        <td><?=$obj['type']?></td>
                        <td><?=$obj['uri']?></td>
                        <td class="text-center">
                            <form action="" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger btn-sm btn-delete">删除</button>
                                <a href="" class="btn btn-warning btn-sm">修改</a>
                            </form>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- 引入 JS 文件 -->
<script src="static/js/jquery-3.3.1.min.js"></script>
<script src="static/js/bootstrap.bundle.min.js"></script>
<script>
    $('.repeat').click(() => {
        alert('重复，自行扩展~')
    })
    $('.hobby').click(()=>{
        location.href = "./hobby.html"
    })
    $('.user').click(() => {
        location.href = '/user.html'
    })
    $('.role').click(() => {
        location.href = '/role.html'
    })
    $('.auth').click(() => {
        location.href = '/auth.html'
    })
</script>
</body>
</html>
<?php

require_once('../connect.php'); // 包含数据库连接信息文件

// 如果表单被提交
if(isset($_POST['submit'])){
    // 获取并清理表单数据
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // 加密密码
    $password = hash('sha256', $password);

    // 在数据库中插入新用户
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    mysqli_query($conn, $query);

    // 跳转到用户列表页
    header("Location: userlist.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加用户</title>
    <link href="//cdn.bootcss.com/argon/1.0.0/css/argon.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <h1>添加用户</h1>

    <form method="post">
        <div class="form-group">
            <label>用户名</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">添加</button>
    </form>

</div>

</body>
</html>

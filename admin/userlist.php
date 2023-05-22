<?php

require_once('../connect.php'); // 包含数据库连接信息文件

// 获取所有用户信息
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>用户列表</title>
    <link href="//cdn.bootcss.com/argon/1.0.0/css/argon.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <h1>用户列表</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="usercg.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">编辑</a>
                    <a href="deluser.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('确定删除该用户吗？')">删除</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="adduser.php" class="btn btn-primary">添加用户</a>

</div>

</body>
</html>

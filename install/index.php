<?php
// 检查是否已安装
if (file_exists('../a.lock')) {
    die('已安装');
}

// 检查是否提交了表单
if (isset($_POST['submit'])) {
    $host = $_POST['host'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $database = $_POST['database'];
    
    // 创建数据库连接
    $conn = mysqli_connect($host, $user, $password);
    
    // 检查连接是否成功
    if (!$conn) {
        die("连接失败: " . mysqli_connect_error());
    }
    
    // 创建数据库
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    if (mysqli_query($conn, $sql)) {
        echo "数据库创建成功";
        
        // 导入数据表
        $conn = mysqli_connect($host, $user, $password, $database);
        $sql = file_get_contents('../a.sql');
        if (mysqli_multi_query($conn, $sql)) {
            echo "数据表创建成功";
            
            // 创建 lock 文件
            $file = fopen('../a.lock', 'w');
            fwrite($file, 'locked');
            fclose($file);
        } else {
            echo "数据表创建失败：" . mysqli_error($conn);
        }
    } else {
        echo "数据库创建失败：" . mysqli_error($conn);
    }

    // 关闭连接
    mysqli_close($conn);
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>安装</title>
    <link rel="stylesheet" href="../argon.css">
</head>
<body>
    <form action="" method="post">
        <label for="host">数据库主机：</label>
        <input type="text" name="host" id="host" value="localhost"><br>
        <label for="user">数据库用户名：</label>
        <input type="text" name="user" id="user"><br>
        <label for="password">数据库密码：</label>
        <input type="password" name="password" id="password"><br>
        <label for="database">数据库名：</label>
        <input type="text" name="database" id="database"><br>
        <button type="submit" name="submit">安装</button>
    </form>
    
    <?php include('../includes/footer.php'); ?>
</body>
</html>

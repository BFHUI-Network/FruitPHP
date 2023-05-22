<?php
// 数据库连接信息
define('DB_HOST', 'localhost'); // 数据库主机
define('DB_USER', 'root'); // 数据库用户名
define('DB_PASS', 'root'); // 数据库密码
define('DB_NAME', 'test'); // 数据库名

// 创建数据库连接
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
?>

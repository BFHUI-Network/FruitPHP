<?php
// 开始会话
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

// 查询用户信息
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php include('../includes/head.php'); ?>

<h1>用户中心</h1>

<p>用户名：<?php echo $row['username'] ?></p>
<p>邮箱：<?php echo $row['email'] ?></p>
<p>注册时间：<?php echo $row['created_at'] ?></p>

<a href="safe1.php">修改密码和用户名</a>
<a href="logout.php">登出</a>

<?php include('../includes/footer.php'); ?>

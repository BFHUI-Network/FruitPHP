<?php
// 开始会话
session_start();

// 检查管理员是否已登录
if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
    exit;
}

// 查询管理员信息
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM admins WHERE id=$admin_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php include('../includes/head.php'); ?>

<h1>后台管理</h1>

<p>用户名：<?php echo $row['username'] ?></p>

<a href="logout.php">登出</a>

<?php include('../includes/footer.php'); ?>

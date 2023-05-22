<?php
// 开始会话
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

// 处理用户提交的表单
if (isset($_POST['submit'])) {
    // 检查旧密码是否正确
    $user_id = $_SESSION['user_id'];
    $old_password = hash('sha256', $_POST['old_password']); // 使用 SHA256 加密密码
    $sql = "SELECT * FROM users WHERE id=$user_id AND password='$old_password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        $error = '旧密码错误';
    } else {
        // 更新密码和用户名
        $new_password = hash('sha256', $_POST['new_password']); // 使用 SHA256 加密密码
        $new_username = $_POST['new_username'];
        $sql = "UPDATE users SET password='$new_password', username='$new_username' WHERE id=$user_id";
        if (mysqli_query($conn, $sql)) {
            $success = '修改成功';
        } else {
            $error = '修改失败';
        }
    }
}

// 查询用户信息
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php include('../includes/head.php'); ?>

<h1>修改密码和用户名</h1>

<?php if (isset($error)): ?>
    <p style="color: red"><?php echo $error ?></p>
<?php endif ?>

<?php if (isset($success)): ?>
    <p style="color: green"><?php echo $success ?></p>
<?php endif ?>

<form action="safe1.php" method="post">
    <div>
        <label for="old_password">旧密码：</label>
        <input type="password" name="old_password" id="old_password" required>
    </div>
    <div>
        <label for="new_password">新密码：</label>
        <input type="password" name="new_password" id="new_password" required>
    </div>
    <div>
        <label for="new_username">新用户名：</label>
        <input type="text" name="new_username" id="new_username" value="<?php echo $row['username'] ?>" required>
    </div>
    <div>
        <button type="submit" name="submit">修改</button>
    </div>
</form>

<a href="index.php">返回</a>
<a href="logout.php">登出</a>

<?php include('../includes/footer.php'); ?>

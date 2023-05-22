<?php
// 开始会话
session_start();

// 检查用户是否已登录
if (isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}

// 处理用户提交的表单
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // 使用 SHA256 加密密码
    
    // 查询用户名和密码是否匹配
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // 登录成功，开始会话
        $_SESSION['user_id'] = $row['id'];
        header('location: index.php');
        exit;
    } else {
        $error = '用户名或密码错误';
    }
}
?>

<?php include('../includes/head.php'); ?>

<h1>用户登录</h1>

<?php if (isset($error)): ?>
    <p style="color: red"><?php echo $error ?></p>
<?php endif ?>

<form action="login.php" method="post">
    <div>
        <label for="username">用户名：</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">密码：</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <button type="submit" name="submit">登录</button>
    </div>
</form>

<?php include('../includes/footer.php'); ?>

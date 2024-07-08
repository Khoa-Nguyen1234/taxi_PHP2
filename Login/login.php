<?php

// Kết nối với cơ sở dữ liệu
$db = new mysqli('localhost', 'root', '', 'test');

// Kiểm tra kết nối
if ($db->connect_error) {
    die('Kết nối thất bại: ' . $db->connect_error);
}

// Xử lý dữ liệu đăng nhập
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Get the selected role

    // Tìm kiếm người dùng
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'"; // Compare passwords directly
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Đăng nhập thành công
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role; // Store the selected role

        // Chuyển hướng dựa trên quyền hạn
        if ($role === 'admin') {
            header('Location: ../admin/index.php'); // Redirect to admin page
        } else if ($role === 'customer') {
            header('Location: ../index.php'); // Redirect to user page
        } else if ($role === 'driver') { // Add driver redirect
            header('Location: ../driver/index.php'); // Redirect to driver page
        } else {
            echo '<p>Quyền hạn không hợp lệ!</p>';
        }

        exit;
    } else {
        echo '<p>Sai tên người dùng hoặc mật khẩu!</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Đăng nhập</title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Tên người dùng:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Quyền hạn:</label>
        <select id="role" name="role" required>
            <option value="admin">Quản trị viên</option>
            <option value="customer" selected>Khách hàng</option>
            <option value="driver">Tài xế</option> </select>

        <button type="submit" name="login">Đăng nhập</button>
    </form>
</body>
</html>
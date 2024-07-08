<?php

// Kết nối với cơ sở dữ liệu
$db = new mysqli('localhost', 'root', '', 'test');

// Kiểm tra kết nối
if ($db->connect_error) {
    die('Kết nối thất bại: ' . $db->connect_error);
}

// Xử lý dữ liệu đăng ký
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Lấy vai trò từ form

    // Kiểm tra trùng tên người dùng
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        echo '<p>Tên người dùng đã tồn tại!</p>';
    } else {
        // Thêm người dùng mới
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

        if ($db->query($sql) === TRUE) {
            echo '<p>Đăng ký thành công! Vui lòng đăng nhập.</p>';
            // Yêu cầu đăng nhập sau khi đăng ký thành công
            header('Location: login.php');
            exit;
        } else {
            echo '<p>Lỗi: ' . $db->error . '</p>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h1>Đăng ký</h1>
        <form action="register.php" method="post">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Vai trò:</label>
            <select id="role" name="role" required>
                <option value="customer">Khách hàng</option>
                <option value="driver">Tài xế</option>
            </select>

            <button type="submit" name="register">Đăng ký</button>
        </form>
    </div>
</body>
</html>
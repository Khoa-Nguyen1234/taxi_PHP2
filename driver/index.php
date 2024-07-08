<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tài Xế</title>
    <link rel="stylesheet" href="driver.css"> </head>
<body>
    <h1>Trang Tài Xế</h1>

    <?php
    session_start();

    // Kiểm tra xem tài khoản đã đăng nhập chưa
    if (isset($_SESSION['username']) && $_SESSION['role'] === 'driver') {
        echo "<p>Xin chào, " . $_SESSION['username'] . "!</p>";
        echo "<p>Bạn đang đăng nhập với vai trò Tài xế.</p>";
        echo "<p><a href='logout.php'>Đăng xuất</a></p>";

        // Thêm nội dung cho trang tài xế ở đây
        // Ví dụ: Hiển thị danh sách đơn hàng, thông tin chuyến đi, v.v.
        echo "<h2>Danh sách đơn hàng</h2>";
        // ... hiển thị danh sách đơn hàng ...
    } else {
        echo "<p>Vui lòng đăng nhập để truy cập trang này.</p>";
        echo "<p><a href='login.php'>Đăng nhập</a></p>";
    }
    ?>
</body>
</html>
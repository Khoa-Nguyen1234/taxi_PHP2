<?php
// Khai báo thông tin kết nối cơ sở dữ liệu
define('HOST', 'localhost'); // Thay thế bằng tên máy chủ của bạn
define('USERNAME', 'root'); // Thay thế bằng tên người dùng của bạn
define('PASSWORD', ''); // Thay thế bằng mật khẩu của bạn
define('DATABASE', 'test'); // Thay thế bằng tên cơ sở dữ liệu của bạn

// Hàm kết nối cơ sở dữ liệu
function connect() {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    return $conn;
}





// ... các hàm khác ... edit

$localhost = "localhost"; // Địa chỉ máy chủ cơ sở dữ liệu (thường là localhost)
$username = "root"; // Tên người dùng cơ sở dữ liệu
$password = ""; // Mật khẩu của người dùng
$dbname = "test"; // Tên cơ sở dữ liệu
 // Tạo kết nối
 $conn = new mysqli($localhost, $username, $password, $dbname);

 // Kiểm tra kết nối
 if ($conn->connect_error) {
     die("Kết nối thất bại: " . $conn->connect_error);
 }


 // Trả về kết nối
 return $conn;


 
?>
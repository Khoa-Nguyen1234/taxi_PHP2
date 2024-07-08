<?php
// Kết nối với cơ sở dữ liệu
require_once '../../db.php'; // Thay 'db.php' bằng file kết nối của bạn

// Kiểm tra xem có dữ liệu được gửi từ AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_type_id = $_POST['car_type_id'];

    // Xóa dữ liệu
    $sql = "DELETE FROM car_types WHERE car_type_id = '$car_type_id'";

    if ($conn->query($sql) === TRUE) {
        echo 'success'; // Trả về kết quả thành công
    } else {
        echo 'error'; // Trả về kết quả lỗi
    }

    // Đóng kết nối
    $conn->close();
}
?>
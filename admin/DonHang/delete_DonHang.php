<?php
require_once('../../database/a.php');

// Lấy kết nối cơ sở dữ liệu
$conn = connect();

// Lấy ID đơn hàng từ URL
$id = $_GET['id'];

// Xóa đơn hàng từ bảng booking_requests
$sql = "DELETE FROM booking_requests WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    // Xóa thành công, chuyển hướng về trang danh sách đơn hàng
    header("Location: DonHang.php");
    exit;
} else {
    // Xóa thất bại, hiển thị lỗi
    echo "Lỗi xóa đơn hàng: " . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
?>
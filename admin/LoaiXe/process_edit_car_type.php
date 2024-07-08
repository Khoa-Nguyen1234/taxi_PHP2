<?php
// Kết nối đến cơ sở dữ liệu
require_once '../../db.php';

// Kiểm tra xem dữ liệu đã được gửi đi hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy ID loại xe từ URL
    $carTypeId = $_GET['id'];

    // Lấy dữ liệu từ form
    $carTypeName = $_POST['car_type_name'];
    $categoryId = $_POST['category_id']; // Lấy ID hãng xe
    $description = $_POST['description'];
    $pricePerDay = $_POST['price_per_day'];
    $quantity = $_POST['quantity']; // Lấy số lượng từ form

    // Xử lý file ảnh (nếu có)
    $imageUrl = '';
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "images_LoaiXe/"; // Thư mục lưu trữ ảnh
        $targetFile = $targetDir . basename($_FILES['image_url']['name']);
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
            $imageUrl = $targetFile;
        } else {
            // Chuyển hướng về trang edit với tham số lỗi
            header("Location: edit_car_type.php?id=$carTypeId&error=upload_error");
            exit;
        }
    }

    // Cập nhật dữ liệu loại xe
    $sql = "UPDATE car_types SET 
            car_type_name = '$carTypeName',
            category_id = '$categoryId', 
            description = '$description',
            price_per_day = '$pricePerDay',
            quantity = '$quantity', 
            image_url = '$imageUrl'
            WHERE car_type_id = '$carTypeId'";

    if ($conn->query($sql) === TRUE) {
        // Nếu cập nhật thành công, chuyển hướng về trang danh sách loại xe
        header("Location: car_types.php");
        exit; 
    } else {
        // Chuyển hướng về trang edit với tham số lỗi
        header("Location: edit_car_type.php?id=$carTypeId&error=update_error"); 
        exit;
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Phương thức yêu cầu không hợp lệ!";
}
?>
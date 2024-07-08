<?php
// Kết nối với cơ sở dữ liệu
require_once '../../db.php';

// Kiểm tra xem form có được submit hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $car_type_name = $_POST["car_type_name"];
    $category_id = $_POST["category_id"];
    $description = $_POST["description"];
    $price_per_day = $_POST["price_per_day"];
    $quantity = $_POST["quantity"];

    // Xử lý ảnh (nếu có)
    $image_url = "";
    if (isset($_FILES["image_url"]) && $_FILES["image_url"]["error"] == 0) {
        $target_dir = "images_LoaiXe/"; // Thư mục lưu trữ ảnh
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng ảnh
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Chỉ chấp nhận tệp JPG, JPEG hoặc PNG.";
        } else {
            // Di chuyển ảnh lên server
            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
                $image_url = $target_file;
            } else {
                echo "Lỗi tải lên tệp.";
            }
        }
    }

    // Chuẩn bị câu lệnh INSERT
    $sql = "INSERT INTO car_types (car_type_name, category_id, description, price_per_day, quantity, image_url) 
            VALUES ('$car_type_name', '$category_id', '$description', '$price_per_day', '$quantity', '$image_url')";

    // Thực thi câu lệnh INSERT
    if ($conn->query($sql) === TRUE) {
        echo "Thêm loại xe thành công!";
        header("Location: car_types.php"); // Chuyển hướng về trang danh sách loại xe
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
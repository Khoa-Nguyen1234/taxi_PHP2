<?php
// Kết nối database
require_once 'db.php';

// Kiểm tra xem form có được submit hay không
if (isset($_POST['submit_booking'])) {
    // Lấy dữ liệu từ form
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $location = $_POST['location'];
    $booking_date = $_POST['booking_date'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $car_type = $_POST['car_type'];
    $quantity = $_POST['quantity'];

    // Kiểm tra số lượng xe còn lại
    $sql = "SELECT quantity FROM car_types WHERE car_type_id = '$car_type'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['quantity'];

        if ($quantity <= $availableQuantity) {
            // Cập nhật số lượng xe còn lại trong database
            $updateSql = "UPDATE car_types SET quantity = quantity - $quantity WHERE car_type_id = '$car_type'";
            if ($conn->query($updateSql) === TRUE) {
                // Chèn dữ liệu vào bảng booking_requests
                $sql = "INSERT INTO booking_requests (full_name, phone_number, location, booking_date, start_date, end_date, car_type, quantity) 
                        VALUES ('$full_name', '$phone_number', '$location', '$booking_date', '$start_date', '$end_date', '$car_type', '$quantity')";

                if ($conn->query($sql) === TRUE) {
                    // Đăng ký thành công, chuyển hướng về trang index.php với thông báo success
                    header("Location: index.php?success=true");
                    exit;
                } else {
                    // Đăng ký thất bại, chuyển hướng về trang index.php với thông báo error
                    header("Location: index.php?error=" . $conn->error);
                    exit;
                }
            } else {
                // Lỗi cập nhật database
                header('Location: Form.php?error=Lỗi cập nhật dữ liệu!');
                exit;
            }
        } else {
            // Số lượng xe vượt quá
            header('Location: Form.php?error=Số lượng xe vượt quá!');
            exit;
        }
    } else {
        // Không tìm thấy loại xe
        header('Location: Form.php?error=Không tìm thấy loại xe!');
        exit;
    }

    // Đóng kết nối
    $conn->close();
}
?>
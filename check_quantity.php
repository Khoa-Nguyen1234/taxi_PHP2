<?php
    // Kết nối với database
    require_once 'db.php';

    // Lấy ID loại xe và số lượng xe từ request
    $carTypeId = $_GET['car_type_id'];
    $quantity = $_GET['quantity'];

    // Truy vấn số lượng xe hiện tại của loại xe
    $sql = "SELECT quantity FROM car_types WHERE car_type_id = '$carTypeId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['quantity'];

        if ($quantity > $availableQuantity) {
            // Số lượng xe vượt quá
            $error = "Số lượng xe vượt quá số lượng còn lại. Vui lòng chọn số lượng khác.";
            echo json_encode(['error' => $error]);
            exit;
        } else {
            // Số lượng xe hợp lệ
            echo json_encode([]);
            exit;
        }
    } else {
        // Không tìm thấy loại xe
        $error = "Không tìm thấy loại xe.";
        echo json_encode(['error' => $error]);
        exit;
    }

    $conn->close();
?>
<?php
require_once('../../database/a.php'); 

// Lấy kết nối cơ sở dữ liệu
$conn = connect();

// Lấy dữ liệu từ bảng booking_requests và car_types
$sql = "SELECT 
    booking_requests.*, 
    car_types.car_type_name,
    car_types.price_per_day
FROM 
    booking_requests 
JOIN 
    car_types ON booking_requests.car_type = car_types.car_type_id";
$result = mysqli_query($conn, $sql); 

?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách Đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Danh sách Đơn hàng</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ Tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt chỗ</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Loại xe</th>
                    <th>Giá/Ngày</th>
                    <th>Trạng thái</th>
                    <th>Số lượng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["full_name"] . "</td>";
                        echo "<td>" . $row["phone_number"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["booking_date"] . "</td>";
                        echo "<td>" . $row["start_date"] . "</td>";
                        echo "<td>" . $row["end_date"] . "</td>";
                        echo "<td>" . $row["car_type_name"] . "</td>";
                        echo "<td>" . number_format(substr($row["price_per_day"], 0, -2), 0, ',', '.') . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td><a href='update_DonHang.php?id=" .  $row["id"] . "' class='btn btn-primary'>Chỉnh sửa</a></td>"; // Nút chỉnh sửa ở cột mới
                        echo "<td><a href='delete_DonHang.php?id=" . $row["id"] . "' class='btn btn-danger'>Xóa</a></td>"; // Nút xóa ở cột mới
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Không có dữ liệu.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
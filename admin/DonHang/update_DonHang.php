<?php
require_once('../../database/a.php');
$conn = connect();

// Kiểm tra xem form đã được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $location = $_POST['location'];
    $booking_date = $_POST['booking_date'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $car_type = $_POST['car_type'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];

    // Cập nhật đơn hàng trong cơ sở dữ liệu
    $sql = "UPDATE booking_requests 
            SET full_name = '$full_name',
                phone_number = '$phone_number',
                location = '$location',
                booking_date = '$booking_date',
                start_date = '$start_date',
                end_date = '$end_date',
                car_type = '$car_type',
                status = '$status',
                quantity = '$quantity'
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Đơn hàng đã được cập nhật thành công.";
        header("Location: DonHang.php"); // Chuyển hướng về trang DonHang.php
    } else {
        echo "Lỗi cập nhật đơn hàng: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

<?php
// Kết nối đến cơ sở dữ liệu (bao gồm cả file a.php)
require_once('../../database/a.php'); 
$conn = connect();

// Lấy ID đơn hàng từ URL
$id = $_GET['id'];

// Sanitize biến $id
$id = mysqli_real_escape_string($conn, $id);

// Lấy thông tin đơn hàng từ cơ sở dữ liệu
$sql = "SELECT 
            booking_requests.*, 
            car_types.car_type_name,
            car_types.price_per_day
        FROM 
            booking_requests 
        JOIN 
            car_types ON booking_requests.car_type = car_types.car_type_id
        WHERE 
            booking_requests.id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem đơn hàng có tồn tại hay không
if (mysqli_num_rows($result) > 0) {
    // Hiển thị form chỉnh sửa
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chỉnh sửa đơn hàng</title>
        <!-- Thêm các liên kết CSS và Javascript cần thiết cho Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h2>Chỉnh sửa đơn hàng</h2>
            <form action="update_DonHang.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="full_name">Họ Tên:</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Số điện thoại:</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">Địa chỉ:</label>
                    <input type="text" class="form-control" id="location" name="location" value="<?php echo $row['location']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="booking_date">Ngày đặt chỗ:</label>
                    <input type="date" class="form-control" id="booking_date" name="booking_date" value="<?php echo $row['booking_date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Ngày bắt đầu:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $row['start_date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Ngày kết thúc:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $row['end_date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="car_type_name">Loại xe:</label>
                    <select class="form-control" id="car_type_name" name="car_type" required>
                        <?php 
                        // Lấy danh sách loại xe từ cơ sở dữ liệu
                        $sql_car_type = "SELECT * FROM car_types";
                        $result_car_type = mysqli_query($conn, $sql_car_type);
                        while ($row_car_type = mysqli_fetch_assoc($result_car_type)) {
                            $selected = ($row['car_type'] == $row_car_type['car_type_id']) ? 'selected' : ''; 
                            echo "<option value='" . $row_car_type['car_type_id'] . "' $selected>" . $row_car_type['car_type_name'] . "</option>";
                        } 
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price_per_day">Giá/Ngày:</label>
                    <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="<?php echo number_format(substr($row['price_per_day'], 0, -2), 0, ',', '.'); ?>" readonly> 
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="chờ duyệt" <?php if ($row['status'] == 'chờ duyệt') echo 'selected'; ?>>Chờ xác nhận</option>
                        <option value="đã chấp nhận" <?php if ($row['status'] == 'đã chấp nhận') echo 'selected'; ?>>Đã xác nhận</option>
                        <option value="bị từ chối" <?php if ($row['status'] == 'bị từ chối') echo 'selected'; ?>>Đã hủy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div>
    </body>
    </html>

    <?php
} else {
    echo "Đơn hàng không tồn tại.";
}

// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);
?>
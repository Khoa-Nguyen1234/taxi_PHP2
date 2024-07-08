<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Đăng Ký</title>
    <link rel="stylesheet" href="Form.css">
</head>
<body>
    <div class="container">
        <h1>Phiếu Đăng Ký Dịch Vụ</h1>
        <?php
            // Hiển thị thông báo
            if (isset($_GET['success'])) {
                echo "<p class='success'>Đăng ký thành công!</p>";
            }
            if (isset($_GET['error'])) {
                echo "<p class='error'>Lỗi: " . $_GET['error'] . "</p>";
            }
        ?>
        <form method="POST" action="process.php">
            <div class="form-group">
                <label for="full_name">Họ và tên:</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Số điện thoại:</label>
                <input type="tel" id="phone_number" name="phone_number" required>
                <span id="phone-error" class="error" style="color: red; display: none;">Số điện thoại không vượt quá 10 số. Vui lòng nhập lại.</span>
            </div>
            <div class="form-group">
                <label for="location">Địa điểm đón khách:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="booking_date">Ngày đặt xe:</label>
                <input type="date" id="booking_date" name="booking_date" required>
            </div>
            <div class="form-group">
                <label for="start_date">Ngày bắt đầu:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">Ngày kết thúc:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="car_type">Loại xe:</label>
                <select id="car_type" name="car_type" required>
                    <?php
                        // Code PHP để hiển thị danh sách các loại xe từ database
                        require_once 'db.php';
                        $sql = "SELECT car_type_id, car_type_name FROM car_types";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["car_type_id"] . "'>" . $row["car_type_name"] . "</option>";
                            }
                        }
                        $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng xe:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
                <span id="quantity-error" class="error" style="color: red; display: none;">Vui lòng nhập số lượng xe.</span>
                <span id="quantity-exceeded" class="error" style="color: red; display: none;"></span>
            </div>
            <button type="submit" name="submit_booking">Đăng ký</button>
        </form>
    </div>

    <script>
        // Kiểm tra số lượng xe khi thay đổi
        document.getElementById('quantity').addEventListener('change', function() {
            // Lấy số lượng xe nhập vào
            const quantity = parseInt(this.value);
            
            // Lấy ID loại xe được chọn
            const carTypeId = document.getElementById('car_type').value;
            
            // Kiểm tra nếu không nhập số lượng
            if (isNaN(quantity) || quantity <= 0) {
                document.getElementById('quantity-error').style.display = 'block';
                document.getElementById('quantity-exceeded').style.display = 'none';
                return;
            }

            // Kiểm tra số lượng xe còn lại trong database
            fetch(`check_quantity.php?car_type_id=${carTypeId}&quantity=${quantity}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        // Số lượng xe vượt quá số lượng còn lại
                        document.getElementById('quantity-error').style.display = 'none';
                        document.getElementById('quantity-exceeded').style.display = 'block';
                        document.getElementById('quantity-exceeded').textContent = data.error;
                    } else {
                        // Số lượng xe hợp lệ
                        document.getElementById('quantity-error').style.display = 'none';
                        document.getElementById('quantity-exceeded').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('quantity-error').style.display = 'block';
                    document.getElementById('quantity-exceeded').style.display = 'none';
                });
        });

        // Kiểm tra số điện thoại khi thay đổi
        document.getElementById('phone_number').addEventListener('input', function() {
            const phoneNumber = this.value;
            const phoneError = document.getElementById('phone-error');

            // Kiểm tra độ dài số điện thoại
            if (phoneNumber.length > 10) {
                phoneError.style.display = 'block';
            } else {
                phoneError.style.display = 'none';
            }
        });
    </script>
</body>
</html>
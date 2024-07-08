<!DOCTYPE html>
<html>
<head>
    <title>Danh sách Loại Xe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="car_types.css">
</head>
<body>
    <div class="container">
        <h2>Danh sách Loại Xe</h2>

        <a href="../index.php" class="btn btn-secondary float-left mb-3">
            <i class="fas fa-arrow-left"></i> Trở về
        </a>
        <!-- Nút Thêm -->
        <a href="add_car_type.php" class="btn btn-primary mb-3">Thêm Loại Xe</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Loại Xe</th>
                    <th>Hãng</th> 
                    <th>ID Hãng</th> <!-- Thêm cột ID hãng -->
                    <th>Mô tả</th>
                    <th>Giá/Ngày</th>
                    <th>Số lượng</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kết nối với cơ sở dữ liệu
                require_once '../../db.php';

                // Truy vấn dữ liệu từ bảng car_types
                $sql = "SELECT car_type_id, car_type_name, c.name as category_name, c.id as category_id, description, price_per_day, image_url, quantity 
                        FROM car_types ct
                        JOIN category c ON ct.category_id = c.id"; 
                $result = $conn->query($sql);

                // Hiển thị dữ liệu trong bảng
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["car_type_id"] . "</td>";
                        echo "<td>" . $row["car_type_name"] . "</td>";
                        echo "<td>" . $row["category_name"] . "</td>"; // Hiển thị tên hãng
                        echo "<td>" . $row["category_id"] . "</td>"; // Hiển thị ID hãng
                        echo "<td>" . $row["description"] . "</td>";
                        // Loại bỏ .00 bằng number_format()
                        echo "<td>" . number_format($row["price_per_day"], 0, '', '') . "</td>"; 
                        echo "<td>" . $row["quantity"] . "</td>"; // Hiển thị cột số lượng
                        echo "<td>";
                        if (!empty($row["image_url"])) {
                            echo "<img src='" . $row["image_url"] . "' alt='" . $row["car_type_name"] . "' width='200'>";
                        }
                        echo "</td>";
                        echo "<td>";
                        // Nút Sửa
                        echo "<a href='edit_car_type.php?id=" . $row["car_type_id"] . "' class='btn btn-warning'>Sửa</a> ";
                        // Nút Xóa (button)
                        echo "<button type='button' class='btn btn-danger delete-car-type' data-id='" . $row["car_type_id"] . "'>Xóa</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có dữ liệu.</td></tr>";
                }

                // Đóng kết nối
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('.delete-car-type').click(function() {
                var carTypeId = $(this).data('id');

                if (confirm('Bạn có chắc muốn xóa loại xe này?')) {
                    // Xóa dữ liệu sử dụng AJAX
                    $.ajax({
                        url: 'delete_car_type.php',
                        type: 'POST',
                        data: { car_type_id: carTypeId },
                        success: function(response) {
                            if (response === 'success') {
                                // Xóa dòng tương ứng trong bảng
                                $(this).closest('tr').remove();
                                alert('Xóa loại xe thành công!');
                            } else {
                                alert('Xóa loại xe thất bại!');
                            }
                        },
                        error: function() {
                            alert('Lỗi xảy ra trong quá trình xóa!');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
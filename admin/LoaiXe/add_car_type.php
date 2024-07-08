<!DOCTYPE html>
<html>

<head>
    <title>Thêm Loại Xe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="car_types.css">
</head>

<body>
    <div class="container">
        <h2>Thêm Loại Xe</h2>

        <form method="post" action="process_add_car_type.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="car_type_name">Tên Loại Xe:</label>
                <input type="text" class="form-control" id="car_type_name" name="car_type_name" required>
            </div>
            <div class="form-group">
                <label for="category_id">Hãng:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php
                    // Kết nối với cơ sở dữ liệu
                    require_once '../../db.php';

                    // Truy vấn danh sách hãng xe
                    $sql = "SELECT id, name FROM category";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                        }
                    }

                    // Đóng kết nối
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="price_per_day">Giá/Ngày:</label>
                <input type="number" class="form-control" id="price_per_day" name="price_per_day" required>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="image_url">Ảnh:</label>
                <input type="file" class="form-control-file" id="image_url" name="image_url">
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="car_types.php" class="btn btn-secondary float-left mb-3">
                <i class="fas fa-arrow-left"></i> Trở về
            </a>
        </form>
    </div>
</body>

</html>
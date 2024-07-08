<!DOCTYPE html>
<html>

<head>
    <title>Sửa Loại Xe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Sửa Loại Xe</h2>

        <?php
        // Kết nối với cơ sở dữ liệu
        require_once '../../db.php';

        // Lấy ID loại xe từ URL
        $car_type_id = $_GET['id'];

        // Truy vấn dữ liệu loại xe từ database
        $sql = "SELECT * FROM car_types WHERE car_type_id = '$car_type_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>

        <?php if (isset($_GET['error'])) { 
            if ($_GET['error'] == 'upload_error') {
                echo "<div class='alert alert-danger'>Lỗi khi tải ảnh lên!</div>";
            } else if ($_GET['error'] == 'update_error') {
                echo "<div class='alert alert-danger'>Lỗi khi cập nhật loại xe!</div>";
            }
        } ?>

        <form method="POST" action="process_edit_car_type.php?id=<?php echo $car_type_id; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="car_type_name">Tên Loại Xe:</label>
                <input type="text" class="form-control" id="car_type_name" name="car_type_name" value="<?php echo $row['car_type_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="category_id">Hãng Xe:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <?php
                    // Truy vấn danh sách hãng xe
                    $sqlCategory = "SELECT * FROM category";
                    $resultCategory = $conn->query($sqlCategory);
                    if ($resultCategory->num_rows > 0) {
                        while ($categoryRow = $resultCategory->fetch_assoc()) {
                            echo "<option value='" . $categoryRow['id'] . "'";
                            if ($categoryRow['id'] == $row['category_id']) {
                                echo " selected";
                            }
                            echo ">" . $categoryRow['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" name="description"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price_per_day">Giá/Ngày:</label>
                <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="<?php echo number_format($row['price_per_day'], 0, '', ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image_url">Ảnh:</label>
                <input type="file" class="form-control-file" id="image_url" name="image_url">
                <?php if (!empty($row['image_url'])) { ?>
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['car_type_name']; ?>" width="100">
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
        </form>

        <?php
        } else {
            echo "Không tìm thấy loại xe.";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>
</body>

</html>
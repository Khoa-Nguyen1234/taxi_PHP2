<?php 
require_once('../database/dbhelper.php'); 
?>


<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="wrapper">
        <header>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="./index.php">Thống kê</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Dichvu/index.php">Quản lý dịch vụ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./LoaiXe/car_types.php">Số lượng loại xe</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="./DonHang/DonHang.php">Quản lý đơn hàng</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./User/user.php">Quản lý tài khoản</a>
                </li>
            </ul>
        </header>
        <div class="container">
            <main>
                <h1>Bảng thống kê</h1>
                <section class="dashboard">
                    <div class="table">
                        <div class="sp dm">
                            <p>Dịch vụ</p>
                            <?php
                            $sql = "SELECT * FROM `category`";
                            $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                            $result = mysqli_query($conn, $sql);
                            echo '<span>' . mysqli_num_rows($result) . '</span>';
                            ?>
                            <p><a href="./Dichvu/index.php">xem chi tiết➜</a></p>
                        </div>
                        <div class="sp">
                            <p>Loại xe</p>
                            <?php
                            $sql = "SELECT * FROM `car_types`";
                            $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                            $result = mysqli_query($conn, $sql);
                            echo '<span>' . mysqli_num_rows($result) . '</span>';
                            ?>
                            <p><a href="./LoaiXe/car_types.php">xem chi tiết➜</a></p>
                        </div>
                        <div class="sp dh">
                            <p>Đơn hàng</p>
                            <?php
                            $sql = "SELECT * FROM `booking_requests`";
                            $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                            $result = mysqli_query($conn, $sql);
                            echo '<span>' . mysqli_num_rows($result) . '</span>';
                            ?>
                            <p><a href="./DonHang/DonHang.php">xem chi tiết➜</a></p>
                        </div>
                        <div class="sp kh">
                            <p>Khách hàng</p>
                            <?php
                            $sql = "SELECT * FROM `users`";
                            $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                            $result = mysqli_query($conn, $sql);
                            echo '<span>' . mysqli_num_rows($result) . '</span>';
                            ?>
                            <p><a href="./User/user.php">xem chi tiết➜</a></p>
                        </div>
                    </div>
                </section>
                <section class="new-order">
                    <h4>Đơn hàng mới</h4>
                    <table>
                        <tr class="bold">
                            <td>STT</td>
                            <td>Họ Tên</td>
                            <td>Loại xe</td>
                            <td>Số điện thoại</td>
                            <td>Ngày bắt đầu</td>
                            <td>Ngày kết thúc</td>
                            <td>Số lượng</td>
                            <td>Trạng thái</td> <!-- Thêm cột trạng thái -->
                        </tr>
                        <?php
                        $sql = "SELECT * FROM `booking_requests` WHERE `status`IN ('chờ duyệt', 'đã chấp nhận')";
                        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $i++ . '</td>';
                                echo '<td>' . $row['full_name'] . '</td>';
                                // Lấy tên loại xe từ bảng `car_types`
                                $carTypeId = $row['car_type'];
                                $sqlCarType = "SELECT `car_type_name` FROM `car_types` WHERE `car_type_id` = $carTypeId";
                                $resultCarType = mysqli_query($conn, $sqlCarType);
                                $carTypeName = mysqli_fetch_assoc($resultCarType)['car_type_name'];
                                echo '<td>' . $carTypeName . '</td>';
                                echo '<td>' . $row['phone_number'] . '</td>';
                                echo '<td>' . $row['start_date'] . '</td>';
                                echo '<td>' . $row['end_date'] . '</td>';
                                echo '<td>' . $row['quantity'] . '</td>'; // Thêm cột số lượng
                                echo '<td>' . $row['status'] . '</td>'; // Hiển thị trạng thái
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7">Chưa có đơn hàng mới</td></tr>'; // Điều chỉnh colspan cho cột mới
                        }
                        ?>
                    </table>
                </section>
            </main>
        </div>
    </div>
</body>
<style>
    #wrapper{
        padding-bottom: 5rem;
    }
    .b-500 {
        font-weight: 500;
    }

    .red {
        color: red;
    }

    .green {
        color: green;
    }
</style>

</html>
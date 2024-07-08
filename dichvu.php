<?php
require_once('./database/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch vụ</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td width="70px">STT</td>
                        <td>Tên dịch vụ</td>
                        <td width="50px"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lấy danh sách hãng
                    $sql = 'select * from category';
                    $categoryList = executeResult($sql);
                    $index = 1;
                    foreach ($categoryList as $item) {
                        echo '  <tr>
                            <td>' . ($index++) . '</td>
                            <td>' . $item['name'] . '</td>
                            <td>
                            <a href="giacuoc.php">
                                <button class=" btn btn-warning">Xem</button> 
                            </a> 
                            </td>
                        </tr>';
                        
                    }
                    ?>
                </tbody>
    </table>
</body>
</html>

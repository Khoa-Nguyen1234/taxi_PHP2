<!DOCTYPE html>
<html>
<head>
  <title>Danh sách khách hàng</title>
  <style>
    body {
      font-family: sans-serif;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 80%;
      margin: 0 auto;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f0f0f0;
    }
  </style>
</head>
<body>

<?php

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn thông tin khách hàng từ cơ sở dữ liệu
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
  // Hiển thị danh sách khách hàng
  echo "<h1>Danh sách khách hàng</h1>";
  echo "<table border='1'>";
  echo "<tr><th>ID</th><th>Tên đăng nhập</th><th>Vai trò</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["user_id"] . "</td>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["role"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "Không có khách hàng nào.";
}

$conn->close();

?>

</body>
</html>
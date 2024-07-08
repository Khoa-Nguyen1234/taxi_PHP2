<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang giá cước</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px 0;
    }

    h1 {
      margin: 0;
      font-size: 2.5em;
    }

    main {
      max-width: 960px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      margin-top: 0;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    footer {
      text-align: center;
      padding: 10px 0;
      background-color: #333;
      color: #fff;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>

  <header>
    <h1>Trang giá cước</h1>
  </header>

  <main>
    <h2>Bảng giá cước</h2>
    <!-- Hiển thị bảng giá cước -->
    <!-- Ví dụ: -->
    <table>
      <thead>
        <tr>
          <th>Tên dịch vụ</th>
          <th>Giá</th>
          <th>Ghi chú</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Vàng SM Taxi</td>
          <td>100.000 VNĐ</td>
          <td>Áp dụng cho khách hàng mới</td>
        </tr>
        <tr>
          <td>Vàng Luxury</td>
          <td>200.000 VNĐ</td>
          <td>Áp dụng cho khách hàng cũ</td>
        </tr>
        <tr>
          <td>Ô Tô Điện</td>
          <td>900.000 VNĐ</td>
          <td>Áp dụng cho khách hàng cũ</td>
        </tr>
      </tbody>
    </table>
  </main>

  <footer>
    <p>© 2023 - Tên công ty</p>
  </footer>

</body>
</html>
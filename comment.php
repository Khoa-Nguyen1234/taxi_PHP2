<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Bình luận</title>
    <link rel="stylesheet" href="comment.css">
</head>
<body>
    <div class="container">
        <div class="comment-section">
            <h2>Thêm Bình luận</h2>
            <form id="comment-form">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" required>
                <label for="comment">Bình luận:</label>
                <textarea id="comment" name="comment" required></textarea>
                <button type="submit">Gửi</button>
            </form>
            <div id="comments-list">
                <!-- Bình luận sẽ hiển thị ở đây -->
                <div class="comment-item">
                    <div class="comment-author">John Doe</div>
                    <div class="comment-content">Đây là một bình luận mẫu.</div>
                </div>
                <div class="comment-item">
                    <div class="comment-author">Jane Doe</div>
                    <div class="comment-content">Bình luận thứ hai, tuyệt vời!</div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
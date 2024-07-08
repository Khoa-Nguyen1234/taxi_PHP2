<?php
require_once('../../database/dbhelper.php');
$id = $name = '';

$baseUrl = '/uploads/images/'; // Set your base URL

if (!empty($_POST['name'])) {
    $name = '';
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $name = str_replace('"', '\\"', $name);
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    if (!empty($name)) {
        $created_at = $updated_at = date('Y-m-d H:s:i');
        // Lưu vào DB
        if ($id == '') {
            // Thêm danh mục
            $sql = 'insert into category(name, created_at,updated_at, image_path) 
            values ("' . $name . '","' . $created_at . '","' . $updated_at . '", "' . $imagePath . '")';
        } 
        else {
            // Sửa danh mục
            $sql = 'update category set name="' . $name . '", updated_at="' . $updated_at . '", image_path="' . $imagePath . '" where id=' . $id;
        }
        execute($sql);

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) { // Only proceed if a new image is uploaded
            $targetDir = 'uploads/images/';
            $targetFile = $targetDir . basename($_FILES['image']['name']);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = $baseUrl . basename($_FILES['image']['name']); // Construct the path

                if ($id == '') {
                    // Insert image path for new category
                    $sql = 'update category SET image_path = "' . $imagePath . '" WHERE id = LAST_INSERT_ID()';
                } else {
                    // Update image path for existing category
                    $sql = 'update category SET image_path = "' . $imagePath . '" WHERE id = ' . $id;
                }
                execute($sql);
            } else {
                echo "Error uploading image.";
            }
        } // End of image upload handling

        header('Location: index.php');
        die();
    }
}

// ... (rest of the code is the same)

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'select * from category where id=' . $id;
    $category = executeSingleResult($sql);
    if ($category != null) {
        $name = $category['name'];
    }
}
?>
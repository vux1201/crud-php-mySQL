<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sinh viên</title>
</head>

<body>
    <?php

    require './students.php';

    // Thực hiện xóa
    $id = isset($_POST['id']) ? (int)$_POST['id'] : '';
    if ($id) {
        delete_student($id);
    }

    // Trở về trang danh sách
    header("location: student-list.php");

    ?>
</body>

</html>
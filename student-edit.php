<?php

require './students.php';
require './validate.php';

// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id) {
    $data = get_student($id);
}

// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data) {
    header("location: student-list.php");
}

// Nếu người dùng submit form
if (!empty($_POST['edit_student'])) {
    // Lay data
    $data['sv_name']        = isset($_POST['name']) ? $_POST['name'] : '';
    $data['sv_sex']         = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['sv_birthday']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['sv_id']          = isset($_POST['id']) ? $_POST['id'] : '';

    // Validate thong tin
    $errors = array();
    if (empty($data['sv_name'])) {
        $errors['sv_name'] = 'Chưa nhập tên sinh vien';
    } elseif (!is_name($data['sv_name'])) {
        $errors['sv_name'] = 'Tên sinh viên không hợp lệ';
    }

    // if (empty($data['sv_sex'])) {
    //     $errors['sv_sex'] = 'Chưa nhập giới tính sinh vien';
    // }

    if (empty($data['sv_birthday'])) {
        $errors['sv_birthday'] = "Chưa nhập ngày sinh";
    } elseif (!is_birthday($data['sv_birthday'])) {
        $errors['sv_birthday'] = 'Yêu cầu tuổi lớn 18 và nhỏ hơn 100';
    }

    // Neu ko co loi thi insert
    if (!$errors) {
        edit_student($data['sv_id'], $data['sv_name'], $data['sv_sex'], date('d/m/Y', strtotime($data['sv_birthday'])));
        // Trở về trang danh sách
        header("location: student-list.php");
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa thông tin sinh viên </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" />
</head>

<body>
    <h1>Sửa thông tin sinh viên </h1>
    <a href="student-list.php">Trở về</a> <br /> <br />
    <form method="post" action="student-edit.php?id=<?php echo $data['sv_id']; ?>">
        <table width="35%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Họ tên</td>
                <td>
                    <input type="text" name="name" value="<?php echo $data['sv_name']; ?>" />
                    <div class="errMes">
                        <?php if (!empty($errors['sv_name'])) echo $errors['sv_name']; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Giới tính</td>
                <td>
                    <select name="sex">
                        <option value="Nam">Nam</option>
                        <option value="Nữ" <?php if ($data['sv_sex'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ngày sinh</td>
                <td>
                    <input type="date" name="birthday" value="<?php echo date('Y-m-d', strtotime($data['sv_birthday']))  ?>">
                    <div class="errMes">
                        <?php if (!empty($errors['sv_birthday'])) echo $errors['sv_birthday']; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $data['sv_id']; ?>" />
                    <input type="submit" name="edit_student" value="Lưu" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
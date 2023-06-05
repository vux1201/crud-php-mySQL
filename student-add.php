<?php

require './students.php';
require './validate.php';

// Nếu người dùng submit form
if (!empty($_POST['add_student'])) {
    // Lay data
    $data['sv_name']        = isset($_POST['name']) ? $_POST['name'] : '';
    $data['sv_sex']         = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['sv_birthday']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';

    // Validate thong tin
    $errors = array();
    if (empty($data['sv_name'])) {
        $errors['sv_name'] = 'Chưa nhập tên sinh viên';
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
        add_student($data['sv_name'], $data['sv_sex'], date('d/m/Y', strtotime($data['sv_birthday'])));
        // Trở về trang danh sách
        header("location: student-list.php");
    }
}

disconnect_db();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm sinh viên</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" />
</head>

<body>
    <h1>Thêm sinh viên </h1>
    <a href="student-list.php">Trở về</a> <br /> <br />
    <form method="post" action="student-add.php">
        <table width="35%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Họ tên</td>
                <td>
                    <input type="text" name="name" value="<?php echo !empty($data['sv_name']) ? $data['sv_name'] : ''; ?>" />
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
                        <option value="Nữ" <?php if (!empty($data['sv_sex']) && $data['sv_sex'] == 'Nữ') echo 'selected'; ?>>Nu</option>
                    </select>
                    <?php /*if (!empty($errors['sv_sex'])) echo $errors['sv_sex'];*/ ?>
                </td>
            </tr>
            <tr>
                <td>Ngày sinh</td>
                <td>
                    <input type="date" name="birthday" value="<?php echo !empty($data['sv_birthday']) ? $data['sv_birthday'] : ''; ?>">
                    <div class="errMes">
                        <?php if (!empty($errors['sv_birthday'])) echo $errors['sv_birthday']; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="add_student" value="Lưu" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
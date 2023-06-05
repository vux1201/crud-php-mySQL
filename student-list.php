<?php
require './students.php';
$students = get_all_students();
disconnect_db();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách sinh vien</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>Danh sách sinh viên</h1>
    <a href="student-add.php">Thêm sinh viên</a> <br /> <br />
    <table width="50%" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>ID</td>
            <td>Họ tên</td>
            <td>Giới tính</td>
            <td>Ngày sinh</td>
            <td>Tùy chọn</td>
        </tr>
        <?php foreach ($students as $item) { ?>
            <tr>
                <td><?php echo '#' . $item['sv_id']; ?></td>
                <td><?php echo $item['sv_name']; ?></td>
                <td><?php echo $item['sv_sex']; ?></td>
                <td><?php echo $item['sv_birthday']; ?></td>
                <td>
                    <form method="post" action="student-delete.php">
                        <input onclick="window.location = 'student-edit.php?id=<?php echo $item['sv_id']; ?>'" type="button" value="Sửa" />
                        <input type="hidden" name="id" value="<?php echo $item['sv_id']; ?>" />
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa" />
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
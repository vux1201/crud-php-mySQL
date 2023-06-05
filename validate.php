<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Validate</title>
</head>

<body>
    <?php

    function is_name($str)
    {
        return (preg_match('
        /^([a-vxyỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđ]+)((\s{1}[a-vxyỳọáầảấờễàạằệếýộậốũứĩõúữịỗìềểẩớặòùồợãụủíỹắẫựỉỏừỷởóéửỵẳẹèẽổẵẻỡơôưăêâđ]+){1,})$/i', $str)) ? true : false;
    }

    function is_birthday($str)
    {
        $year = substr($str, 0, 4);
        $current_year = date('Y');
        $year_old = $current_year - $year;
        // echo $year;
        // $new_date = date('d/m/Y', strtotime($old_date));
        if ($year_old > 100 || $year_old < 18) {
            return false;
        } else return true;
    }

    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drawer</title>
</head>

<body>
    <?php
    function getColor(int $color, bool $is_invert = false)
    {
        if(0xFFFFFF < $color) {
            $color = $color % 0xFFFFFF;
        }
        $Color = ($is_invert) ? 0xFFFFFF - $color : $color;

        if ($Color == 0) return '#000';
        $str = dechex($Color);
        $len = 6 - strlen($str);
        for($i = 0; $i < $len; $i++)
            $str .= "0"; 
        return '#' . $str;
    }
    function createRect(int $x, int $y, int $width, int $height, int $color, float $stroke)
    {
        $str = ($stroke > 0) ? ' stroke=' . getColor($color, true) . ' stroke-width="' . $stroke . '"' : '';
        return "<rect x=" . $x . " y=" . $y . " width=" . $width . " height=" . $height . ' ' . $str . ' style="fill: ' . getColor($color) . '" />';
    }
    function createCircle(int $x, int $y, int $r, int $color, float $stroke)
    {
        $str = ($stroke > 0) ? ' stroke=' . getColor($color, true) . ' stroke-width="' . $stroke . '"' : '';
        return "<circle cx=" . $x . " cy=" . $y . " r=" . $r . ' style="fill:' . getColor($color) . '"' . $str . ' />';
    }
    ?>

    <?php

    $svg_begin = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice">';
    $svg_end   = '</svg>';

    $param = $_GET['num'];
    if (isset($param) & is_numeric($param)) {
        
        $color = $param;


        $height = ($param << 5) & 127;

        $width = ($param << 4) & 127;

        echo "Height = " . $height . "<br> Whidth = " . $width;

        echo $svg_begin;
        //echo createRect(10, 10, 100, 100, hexdec("4a71db"), 0);
        if($width > 100)
            echo createCircle(10, 10, 5, $color, 1);
        else
            echo createRect(10, 10, $width, $height, $color, 1);

        echo $svg_end;
    } else {
        echo 'Bad Request';
    }

    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort</title>
</head>

<body>
    <?php
    //Сортировка слиянием
    function insertSort(array $arr)
    {
        $count = count($arr);
        if ($count <= 1) {
            return $arr;
        }

        for ($i = 1; $i < $count; $i++) {
            $cur_val = $arr[$i];
            $j = $i - 1;

            while (isset($arr[$j]) && $arr[$j] > $cur_val) {
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $cur_val;
                $j--;
            }
        }

        return $arr;
    }


    $param = $_REQUEST['array'];
    if(!isset($param)){
        echo "Bad Request"; 
    }
    $array = explode(',', $param);
    echo "Исходный массив: " . implode(",", $array) . "<br> Отсортированный массив: " . implode(",", insertSort($array));
    ?>
</body>

</html>
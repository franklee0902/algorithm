<?php

require "helper.php";

// 插入排序
function insertionSort(array &$arr) {
    $length = count($arr);

    for ($i = 1; $i < $length; $i++){

        $e = $arr[$i];
        $j = $i;
        for(; $j > 0 && $arr[$j - 1] > $e; $j--){
            $arr[$j] = $arr[$j - 1];
        }

        $arr[$j] = $e;
    }
}

$n = 10;
$arr = generateRandomArray($n, 0, 10);
testSort("insertionSort", $arr);

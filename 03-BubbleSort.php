<?php

require "helper.php";

// 冒泡排序，时间复杂度为：O(N^2),是稳定的排序算法
function bubbleSort(array &$arr) {
    $length = count($arr);

    for ($i = $length -1; $i > 0; $i--){
        $flag = false;
        for($j = 0; $j < $i; $j++){
            if($arr[$j] > $arr[$j + 1]){
                swap($arr[$j], $arr[$j + 1]);
                $flag = true;
            }
        }
        if(!$flag){
            break;
        }
    }
}

$n = 10;
$arr = generateRandomArray($n, 0, 10);
testSort("bubbleSort", $arr);

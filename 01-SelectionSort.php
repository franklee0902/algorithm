<?php

require "helper.php";

// 选择排序，时间复杂度为：O(N^2) ，不稳定（因为在swap会打破稳定性）
function selectionSort(array &$arr) {
    $length = count($arr);

    for ($i = 0; $i < $length; $i++){
        $minIndex = $i;
        for($j = $i + 1; $j < $length; $j++){
            if($arr[$j] < $arr[$minIndex]) {
                $minIndex = $j;
            }
        }

        swap($arr[$i], $arr[$minIndex]);
    }
}

$n = 100;
$arr = generateRandomArray($n, 0, 100);
testSort("selectionSort", $arr);

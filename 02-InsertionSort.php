<?php

require "helper.php";

// 插入排序
// 优势：1、数组基本有序，时间复杂度趋于O(N);
// 2、因为算法比较简单，时间复杂度的常熟C比较小，所以数据规模比较的时候效率比较高
function insertionSort(array &$arr) {
    $length = count($arr);

    for ($i = 1; $i < $length; $i++){

        $e = $arr[$i];
        $j = $i;

        // 优化：1、用赋值替换swap，减少机器指令 ，提高算法效率
        // 2、$arr[$j - 1] > $e 条件不满足，提前终止
        for(; $j > 0 && $arr[$j - 1] > $e; $j--){
            $arr[$j] = $arr[$j - 1];
        }

        $arr[$j] = $e;
    }
}

$n = 10;
$arr = generateRandomArray($n, 0, 10);
testSort("insertionSort", $arr);

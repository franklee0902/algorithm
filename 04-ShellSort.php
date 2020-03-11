<?php

require "helper.php";

// 希尔排序,它是基于插入排序算法的改进版，对于中等数据规模数据性能表现还不错
function shellSort(array &$arr) {
    $length = count($arr);

    // 对待排序的数据进行分组，最开始的时候增量（gap）为数组长度的一半
    for ($gap = $length / 2; $gap > 0; $gap /= 2){

        // 对各分组进行插入排序
        for($i = $gap; $i < $length; $i++){
            insertI($arr, $gap, $i);
        }
    }
}

// 将 arr[i] 插入到增量为 gap 的所在分组的正确位置上 （和插入排序的内层循环逻辑基本一致）
function insertI(array &$arr, int $gap, int $i) {
    $e = $arr[$i];
    $j = $i;
    for(; $j >= $gap && $arr[$j - $gap] > $e; $j -= $gap){
        $arr[$j] = $arr[$j - $gap];
    }

    $arr[$j] = $e;
}

$n = 10;
$arr = generateRandomArray($n, 0, 10);
testSort("shellSort", $arr);

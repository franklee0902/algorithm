<?php

require "helper.php";


// 对arr[l...r]范围内的数据进行插入排序
function __insertionSort(array &$arr, int $l, int $r) {
    for($i = $l + 1; $i <= $r; $i++){
        $e = $arr[$i];
        $j = $i;
        for(; $j > $l && $arr[$j - 1] > $e; $j--){
            $arr[$j] = $arr[$j - 1];
        }
        $arr[$j] = $e;
    }
}

// 将arr[l...r]进行partition操作
// 返回索引值 p，使得 : arr[l...p-1] < arr[p] && arr[p+1...r] > arr[p]
function __partition(array &$arr, int $l, int $r) {
    swap($arr[$l], $arr[rand($l, $r)]);
    $v = $arr[$l];

    // arr[l+1...j] < v && arr[j+1...i)>v
    $j = $l; $i = $l + 1;
    for(; $i <= $r; $i++){
        if($arr[$i] < $v){
            swap($arr[++$j], $arr[$i]);
        }
    }
    swap($arr[$j], $arr[$l]);
    return $j;
}

// 递归使用快速排序，对arr[l...r]范围内的数据进行排序
function __quickSort(array &$arr, int $l, int $r) {

//    if($l >= $r)
//        return;

    // 小数据规模用插入排序做优化
    if($r - $l <= 15){
        __insertionSort($arr, $l, $r);
        return;
    }


    $p = __partition($arr, $l, $r);
    __quickSort($arr, $l, $p - 1);
    __quickSort($arr, $p + 1, $r);
}

// 单路快速排序算法，时间复杂度是O(NlogN),空间复杂度是O(1)，非稳定排序
// 单路快速排序对于存在大量重复数据的待排序数据，会出现partition之后两边数据会出现不平衡的的情况，导致性能下降
function quickSort(array &$arr) {
    $length = count($arr);
    __quickSort($arr, 0, $length -1);
}



$n = 10000;
$arr = generateRandomArray($n, 0, 10000);
testSort("quickSort", $arr);

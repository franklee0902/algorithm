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

// 递归使用快速排序，对arr[l...r]范围内的数据进行排序
function __quickSort3Ways(array &$arr, int $l, int $r) {

//    if($l >= $r)
//        return;

    // 小数据规模用插入排序做优化
    if($r - $l <= 15){
        __insertionSort($arr, $l, $r);
        return;
    }

    // 添加随机优化，解决数组近乎有序的情况快速排序退化为O(N^2)的问题
    swap($arr[$l], $arr[rand($l, $r)]);
    $v = $arr[$l];

    // 循环不变量：arr[l+1...lt] < v && arr[lt+1...i) = v && arr[gt...r] > v
    $lt = $l;
    $gt = $r + 1;
    $i = $l + 1;
    while ($i < $gt){
        if($arr[$i] < $v)
            swap($arr[++$lt], $arr[$i++]);
        else if($arr[$i] == $v)
            $i++;
        else
            swap($arr[$i], $arr[--$gt]);
    }
    swap($arr[$l], $arr[$lt--]);

    __quickSort3Ways($arr, $l, $lt);
    __quickSort3Ways($arr, $gt, $r);
}

// 三路快速排序算法，时间复杂度是O(NlogN),空间复杂度是O(1)，非稳定排序
// 三路快速排序对于存在大量重复数据的待排序数据做了更进一步的优化，
// partition操作会直接把待排序的数据分成3部分：< v、= v、> v
function quickSort3Ways(array &$arr) {
    $length = count($arr);
    __quickSort3Ways($arr, 0, $length -1);
}



$n = 10000;
$arr = generateRandomArray($n, 0, 10000);
testSort("quickSort3Ways", $arr);

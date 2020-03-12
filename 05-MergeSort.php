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

// 将arr[l...mid]和arr[mid+1...r]两部分进行归并
function __merge(array &$arr, int $l, int $mid, int $r) {
    // 使用辅助空间帮助归并
    $aux = [];
    for($i = $l; $i <= $r; $i++)
        $aux[$i - $l] = $arr[$i];

    $i = $l; $j = $mid + 1;
    for($k = $l; $k <= $r; $k++){
        if($i > $mid){  // 如果左半部分元素已经全部处理完毕
            $arr[$k] = $aux[$j - $l];
            $j++;
        }else if($j > $r){  // 如果右半部分元素已经全部处理完毕
            $arr[$k] = $aux[$i - $l];
            $i++;
        }else if($aux[$i - $l] <= $aux[$j - $l]){ // 左半部分所指元素 <= 右半部分所指元素(注意：必须<=才满足稳定性)
            $arr[$k] = $aux[$i - $l];
            $i++;
        }else{ // 左半部分所指元素 > 右半部分所指元素
            $arr[$k] = $aux[$j - $l];
            $j++;
        }
    }
}

// 递归使用归并排序，对arr[l...r]范围内的数据进行排序
function __mergeSort(array &$arr, int $l, int $r) {

//    if($l >= $r)
//        return;

    // 小数据规模用插入排序做优化
    if($r - $l <= 15){
        __insertionSort($arr, $l, $r);
        return;
    }


    // 防止溢出
    $mid = (int)(($r - $l) / 2) + $l;
    __mergeSort($arr, $l, $mid);
    __mergeSort($arr, $mid + 1, $r);

    // 优化：如果两个区间本来就有序则不用归并
    if($arr[$mid] > $arr[$mid + 1])
        __merge($arr, $l, $mid, $r);
}

// 归并排序的时间复杂度是O(NlogN),空间复杂度是O(N)，因为在合并否时候需要额外的辅助空间，稳定排序
function mergeSort(array &$arr) {
    $length = count($arr);
    __mergeSort($arr, 0, $length -1);
}



$n = 10000;
$arr = generateRandomArray($n, 0, 10000);
testSort("mergeSort", $arr);

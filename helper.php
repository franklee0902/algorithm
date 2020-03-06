<?php

// 生成n个元素的随机数组，每个元素的随机范围为[rangeL, rangeR]
function generateRandomArray(int $n, int $rangeL, int $rangeR) : array {

    assert( $rangeR >= $rangeL);

    $arr = [];
    for($i = 0; $i < $n; $i++){
        $arr[] = rand($rangeL, $rangeR);
    }
    return $arr;
}

// 生成一个近乎有序的数组
// 首先生成一个含有[0...n-1]的完全有序数组, 之后随机交换swapTimes对数据
// $swapTimes定义了数组的无序程度:
// $swapTimes == 0 时, 数组完全有序
// $swapTimes 越大, 数组越趋向于无序
function generateNearlyOrderArray(int $n, int $swapTimes){
    $arr = [];
    for($i = 0; $i < $n; $i++){
        $arr[$i] = $i;
    }

    for($i = 0; $i < $swapTimes; $i++){
        $posX = rand(0, $n -1);
        $posY = rand(0, $n -1);
        swap($posX, $posY);
    }

    return $arr;
}

// 交换两个元素
function swap(&$a, &$b){
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}

// 判断arr是否有序
function isSorted(array &$arr){
    $length = count($arr);
    for($i = 1; $i < $length; $i++ ){
        if($arr[$i] < $arr[$i - 1]){
            return false;
        }
    }
    return true;
}

// 打印arr数组的所有内容
function printArray(array &$arr){
    foreach ($arr as $v){
        echo $v . " ";
    }
    echo "\n";
}

// 测试sort排序算法排序arr数组所得结果的正确性及算法运行时间
function testSort(string $sortName, array &$arr){
    $startTime = microtime(true);
    $sortName($arr);
    $endTime = microtime(true);

    assert(isSorted($arr));
    printArray($arr);
    printf("%s : %f", $sortName, ($endTime - $startTime));
}

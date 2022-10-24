<?php
$area = array(
    'china' => array(
        '上海' => '上海1',
        '湖北',
        '天津',
        array(
            'hd' => '海淀',
            '朝阳',
            '房山',
            'cp' => '昌平',
        ),
        '广东' => array(
            '深圳',
            '广州',
            '佛山',
            'dg' => '东莞',
        ),
    ),
    'usa' => array(
        '华盛顿',
        '旧金山',
        '纽约' => array(
            '曼哈顿区',
            '皇后区',
            '布鲁克林区',
        ),
    ),
);

//
//$area1 = $area["china"];
////print_r($area1["北京"]);
//$add = ['openId' => '1'];
//
//$num = count($area1);
//print_r($num);
//for ($i = 0; $i <= $num; $i++) {
//    $tempAry = $area1[$i];
//
////    $recentDailyPlayHistories = $tempAry['dailyPlayHistories'];
//    $add['playedDate'] = $i;
//    //   print_r($add);
////    array_walk($tempAry, function (&$value, $k, $add) {
////        $value = array_merge($value, $add);
////    }, $add);
//    $tempAry = array_merge($tempAry, $add);
//    print_r($tempAry);
//}


$rse = array();
foreach ($area["china"] as $k => $v) {
    foreach ($v as $key => $value) {
        $rse[$key] = $value;
    }
}

print_r($rse);




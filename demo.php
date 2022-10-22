<?php

require_once("./src/app/Model/Nintendo/NintendoPlayHistories.php");

$header = array();
$header[] = 'Cache-Control:no-cache';
$header[] = 'Connection:Keep-Alive';
$header[] = 'Host:mypage-api.entry.nintendo.co.jp';
$header[] = 'Authorization:Bearer eyJraWQiOiI1NWJmZTIyOS1mNTA1LTQzOWQtOTljMS1hMzM5MWYwYjY3OTMiLCJqa3UiOiJodHRwczovL2FjY291bnRzLm5pbnRlbmRvLmNvbS8xLjAuMC9jZXJ0aWZpY2F0ZXMiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NjY0NTgxMjksImF0X2hhc2giOiJoNm5HcjdpT2YzYzVteklIUUpUNHFnIiwiY291bnRyeSI6IkpQIiwiYXVkIjoiNWMzOGUzMWNkMDg1MzA0YiIsImV4cCI6MTY2NjQ1OTAyOSwic3ViIjoiMTg5MDBjNmQ4MzhkN2I4ZSIsImp0aSI6ImY5ZTcyYzgzLTM0NjctNGVhMi04MzdiLTJiYzIyYWJjYjExYiIsImlzcyI6Imh0dHBzOi8vYWNjb3VudHMubmludGVuZG8uY29tIiwidHlwIjoiaWRfdG9rZW4ifQ.D82gRnK6a4X5zly3zOYEvIFhaF6QhUPNDgCk_ccQJxPsCYsz5uAU0iZg1vi0QQvZ3-He6-uQgfoFX8TlD_kkkj2FKhb7MjpVe8bl6cuhwh9MBjGFk8V-2ZF1JOONPTS51sbLwMF9eNZm_WxDe-EnHepWRyevBf7cFdgkU-c-NGpic3Fh1RTbxuBF4rnU78sYwFmZEBmAmrucD2IEgyUrs8JChkPVos9UFZv81HuRJH_N8KtiVeHHWDH1Pi_-SGUik67baSs9_Bm5zNoYWizbUYcy4yTylVaaW8uDkZ6f755_LPZmLD_uy9Kxlo4rCxgE_ZLh5mZ4jC6FrUz45Wvm4w';


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://mypage-api.entry.nintendo.co.jp/api/v1/users/me/play_histories');
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_USERAGENT, 'com.nintendo.znej/1.14.0 (Android/7.1.2)');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
//规避SSL验证
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//跳过HOST验证
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result, true);


//$result['china'] = array_values(array_filter($area['china'], function($t) { return $t['纽约'] == null; }));

$add = ['openId' => '1'];
//二维数组追加字段给所有数组追加
array_walk($result[playHistories], function (&$value, $k, $add) {
    $value = array_merge($value, $add);
}, $add);

$playHistories = $result[playHistories];

print_r($playHistories);
print_r("-------------");

$num = count($playHistories);

for ($i = 0; $i < $num; $i++) {
    $tempArry = $playHistories[$i];
    $code = (new App\Domain\Nintendo\NintendoPlayHistories)->fetchOne($tempArry[titleId], $tempArry[openId]);
    if ($code) {
        print_r('插入值');
    }
}







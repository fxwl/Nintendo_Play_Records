<?php

namespace App\Domain\Nintendo;

use App\Model\Nintendo\NintendoPlayHistories as ModelNintendoPlayHistories;
use App\Domain\WeiXin\WeiXin as DomainWeiXin;

class NintendoPlayHistories
{
    public function insert($newData)
    {
        $model = new ModelNintendoPlayHistories();
        return $model->insert($newData);
    }

    public function update($id, $newData)
    {
        $model = new ModelNintendoPlayHistories();
        return $model->update($id, $newData);
    }

    public function get($id)
    {
        $model = new ModelNintendoPlayHistories();
        return $model->get($id);
    }

    public function delete($id)
    {
        $model = new ModelNintendoPlayHistories();
        return $model->delete($id);
    }
}


//获取游戏目录及时间
function GetPlayHistories($Authorization)
{
    $header = array();
    $header[] = 'Cache-Control:no-cache';
    $header[] = 'Connection:Keep-Alive';
    $header[] = 'Host:mypage-api.entry.nintendo.co.jp';
    $header[] = 'Authorization:Bearer ' . $Authorization;

    print_r($header);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://mypage-api.entry.nintendo.co.jp/api/v1/users/me/play_histories');
    //curl_setopt($ch, CURLOPT_HEADER, false);
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


    return $result;

}

//获取Authorization
function PostAuthorization($clientId, $sessionToken)
{
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'Accept: application/json';
    $header[] = 'Host: accounts.nintendo.com';
    $header[] = 'Connection: Keep-Alive';
    $header[] = 'Accept-Encoding: gzip';
    $header[] = 'Content-Length: 437';


    $data = '{"client_id":"' . $clientId . '","session_token":"' . $sessionToken . '","grant_type":"urn:ietf:params:oauth:grant-type:jwt-bearer-session-token"}';

    //print_r($header);
    //print_r($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.nintendo.com/connect/1.0.0/api/token');
    //curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_USERAGENT, 'com.nintendo.znej/1.14.0 (Android/7.1.2)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    //规避SSL验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //跳过HOST验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');

    //发起post请求
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);
    curl_close($ch);

     $newData = array(
                'id' => $result->id,
                'Authorization' => $result->access_token,
            );

    $DomainPostAuthorization = new DomainWeiXin();
    $code = $domain->update($this->id, $newData);

    return $result;

}

//在数组中通过key取value
function recur($key, $array): string
{
    $data = [];
    array_walk_recursive($array, function ($v, $k) use ($key, &$data) {
        if ($k === $key) {
            array_push($data, $v);
        }
    });
    //返回值设置为字符串
    return implode($data);
}


$Authorization = "JraWQiOiI1MTYzZWIxOS1kMGRhLTRjMDUtOTBkNC00N2YwZjcyYThkNzAiLCJhbGciOiJSUzI1NiIsImprdSI6Imh0dHBzOi8vYWNjb3VudHMubmludGVuZG8uY29tLzEuMC4wL2NlcnRpZmljYXRlcyJ9.eyJpYXQiOjE2NjM3NzExMjQsInR5cCI6InRva2VuIiwianRpIjoiNGY0ZTQ4MWEtYmY2My00YWVkLWJiODYtMGYxZTk4ZmYxZGVhIiwiaXNzIjoiaHR0cHM6Ly9hY2NvdW50cy5uaW50ZW5kby5jb20iLCJzdWIiOiIxODkwMGM2ZDgzOGQ3YjhlIiwiZXhwIjoxNjYzNzcyMDI0LCJhdWQiOiI1YzM4ZTMxY2QwODUzMDRiIiwiYWM6Z3J0Ijo2NCwiYWM6c2NwIjpbMCw4LDEwLDEyLDE3XX0.AIBAmWN2mBLybk8icXkRAi2_oqgSHzAIuUnkSCbJuSsbJuxA4doZdF-JFD3qnKPfPlZOwoFODMuVP6IiQpwwSA7ejHZ3nxSVgObuyrbG91fRWxMBWurEIjGfONtvbL9S0zHJlLlnXrX7HeFexKvlgexBN85InTIQKYymvlu8GxzD1IdhHdZ8a5xkPn9UT1ozi9IvPZZS2npoRM0beX4I7DAthMsdAxjYr-XRgWDRqUjuFlTfm8hWX9FUzVvagp99B6St1r28PIU4YCYv92NuGhXFddrG9-F--P_pTp5Mkc3QXLkKDPoinUTgJnwR8EcaCFY40uP05te1Cm33YMDuwg";

$clientId = '5c38e31cd085304b';
$sessionToken = 'eyJhbGciOiJIUzI1NiJ9.eyJleHAiOjE3MjY1NzIxODksImp0aSI6OTg4Mzc3NjQ1MSwiaWF0IjoxNjYzNTAwMTg5LCJhdWQiOiI1YzM4ZTMxY2QwODUzMDRiIiwic3ViIjoiMTg5MDBjNmQ4MzhkN2I4ZSIsInN0OnNjcCI6WzAsOCwxMCwxMiwxN10sImlzcyI6Imh0dHBzOi8vYWNjb3VudHMubmludGVuZG8uY29tIiwidHlwIjoic2Vzc2lvbl90b2tlbiJ9.8ZE3FHm4W3ioj0ywI0qPpWZhCtnhwX8hegVUmxqnxU0';

//取游戏时长
$GetPlayHistories = GetplayHistories($Authorization);
print_r($GetPlayHistories);
$GetPlayHistoriesJson = json_decode($GetPlayHistories);

if (property_exists($GetPlayHistoriesJson, 'code')) {
    print_r('获取Authorization');
    $PostAuthorization = PostAuthorization($clientId, $sessionToken);
    $PostAuthorizationJson = json_decode($PostAuthorization);
    /*  */
    print_r($PostAuthorizationJson);

    $Authorization = recur('access_token', $PostAuthorizationJson);

    print_r($Authorization);
    $GetPlayHistories = GetplayHistories($Authorization);
    $GetPlayHistoriesJson = json_decode($GetPlayHistories);
}

//$res = PostAuthorization($clientId,$session_token);

//$res = GetplayHistories($Authorization);
//$Json=json_decode($res);   

print_r($GetPlayHistoriesJson);

?>
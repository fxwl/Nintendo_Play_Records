<?php

namespace App\Domain\Nintendo;

class NintendoInterface
{
    //在数组中通过key取value
    public function recur($key, $array)
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

    //获取游戏目录及时间
    public function GetPlayHistories($Authorization)
    {
        $header = array();
        $header[] = 'Cache-Control:no-cache';
        $header[] = 'Connection:Keep-Alive';
        $header[] = 'Host:mypage-api.entry.nintendo.co.jp';
        $header[] = 'Authorization:Bearer ' . $Authorization;


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

        $result = json_decode($result);

        return $result;

    }

    //获取玩家信息
    public function GetUsersMe($Authorization)
    {
        $header = array();
        $header[] = 'Accept-Language: zh-CN';
        $header[] = 'Content-Type: application/json';
        $header[] = 'Connection:Keep-Alive';
        $header[] = 'Host:api.accounts.nintendo.com';
        $header[] = 'Authorization:Bearer ' . $Authorization;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.accounts.nintendo.com/2.0.0/users/me');
        //curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'NASDKAPI; Android');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        //规避SSL验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //跳过HOST验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        return $result;
    }

    //获取游戏时间数据
    public function GetUsersMePoints($Authorization)
    {
        $header = array();
        $header[] = 'Accept-Language: zh-CN';
        $header[] = 'Connection:Keep-Alive';
        $header[] = 'Host:mypage-api.entry.nintendo.co.jp';
        $header[] = 'Cache-Control: no-cache';
        $header[] = 'Authorization:Bearer ' . $Authorization;

        print_r($header);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://mypage-api.entry.nintendo.co.jp/api/v1/users/me/points');
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

    //获取游戏时间数据
    public function GetPlayHistoriesGameTitles($Authorization, $GameId, $Offset)
    {
        $header = array();
        $header[] = 'Accept-Language: zh-CN';
        $header[] = 'Connection:Keep-Alive';
        $header[] = 'Host:mypage-api.entry.nintendo.co.jp';
        $header[] = 'Cache-Control: no-cache';
        $header[] = 'Authorization:Bearer ' . $Authorization;

        if (empty($Offset)) {
            $url = 'https://mypage-api.entry.nintendo.co.jp/api/v1/users/me/play_histories/game_titles/' . $GameId;
        } else {
            $url = 'https://mypage-api.entry.nintendo.co.jp/api/v1/users/me/play_histories/game_titles/' . $GameId . '?offset=' . $Offset;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
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
    public function PostAuthorization($clientId, $sessionToken)
    {
        $header = array();
        $header[] = 'Content-Type: application/json';
        $header[] = 'Accept: application/json';
        $header[] = 'Host: accounts.nintendo.com';
        $header[] = 'Connection: Keep-Alive';
        $header[] = 'Accept-Encoding: gzip';
        $header[] = 'Content-Length: 437';


        $data = '{"client_id":"' . $clientId . '","session_token":"' . $sessionToken . '","grant_type":"urn:ietf:params:oauth:grant-type:jwt-bearer-session-token"}';


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

        return $result;

    }

}
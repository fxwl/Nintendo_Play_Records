<?php

namespace App\Domain\Nintendo;

use App\Domain\Nintendo\NintendoGURD as NintendoGURD;
use App\Domain\WeiXin\WeiXin as DomainWeiXin;

class NintendoInterface
{
    //在数组中通过key取value
    public function recur($key, $array): string
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
    public function GetPlayHistories($openId, $Authorization)
    {

        //header设置
        $header = array();
        $header[] = 'Cache-Control:no-cache';
        $header[] = 'Connection:Keep-Alive';
        $header[] = 'Host:mypage-api.entry.nintendo.co.jp';
        $header[] = 'Authorization:Bearer ' . $Authorization;

        //发起请求获取数据
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
        //将游戏数据转化为数组
        $result = json_decode($result, true);

        //需要插入对应的openId
        $add = ['openId' => $openId];


        //更新游戏中数据

        //开始添加游戏总数据，下列代码主要用于将$result[playHistories]中每一个数组都添加一个$openId
        array_walk($result['playHistories'], function (&$value, $k, $add) {
            $value = array_merge($value, $add);
        }, $add);

        $playHistories = $result['playHistories'];
        $num = count($playHistories);
        $NintendoGURD = new NintendoGURD();
        for ($i = '0'; $i < $num; $i++) {
            $tempAry = $playHistories[$i];
            $code = $NintendoGURD->fetchOnePlayHistories($tempAry['titleId'], $tempAry['openId']);
            if ($code) {
                $NintendoGURD->updateAllPlayHistories($tempAry['openId'], $tempAry['titleId'], $tempAry);
            } else {
                $NintendoGURD->insertMultiPlayHistories($tempAry);
            }
        }

        //更新最近七天的游戏数据
        $recentPlayHistories = $result['recentPlayHistories'];
        $num = count($recentPlayHistories);
        $NintendoGURD = new NintendoGURD();
        for ($i = '0'; $i < $num; $i++) {
            $tempAry = $recentPlayHistories[$i];
            //比起游戏数据表，需要多添加一个时间元素
            $add['playedDate'] = $tempAry["playedDate"];
            //只获取当天的游戏列表，剔除时间
            $dailyPlayHistories = $tempAry['dailyPlayHistories'];

            $tempNum = count($dailyPlayHistories);
            for ($tempI = '0'; $tempI < $tempNum; $tempI++) {
                $tempAry1 = array_merge($dailyPlayHistories[$tempI], $add);
                if (count($tempAry1) > 0) {
                    $code = $NintendoGURD->fetchOneRecentPlayHistories($tempAry1['titleId'], $tempAry1['openId'], $tempAry1['playedDate']);
                    if ($code) {
                        $NintendoGURD->updateAllRecentPlayHistories($tempAry1['openId'], $tempAry1['titleId'], $tempAry1['playedDate'], $tempAry1);
                    } else {
                        $NintendoGURD->insertMultiRecentPlayHistories($tempAry1);
                    }
                }
            }
        }
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
    public function PostAuthorization($clientId, $sessionToken, $openId)
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

        $arResult = json_decode($result);
        $accessToken = $this->recur('access_token', $arResult);
        $idToken = $this->recur('id_token', $arResult);

        $DomainWeiXin = new  DomainWeiXin();
        $updateAll = $DomainWeiXin->updateAll($openId, $accessToken, $idToken, $clientId, $sessionToken);

        return $arResult;

    }

}
<?php

namespace App\Domain\Nintendo;

use App\Domain\Nintendo\NintendoInterface as DomainNintendoInterface;
use App\Domain\WeiXin\WeiXin as DomainWeiXin;


class Nintendo
{

    public function GetPlayHistories($openId)
    {
        $DomainWeiXin = new  DomainWeiXin();
        $DomainNintendoInterface = new DomainNintendoInterface();

        //获取$Authorization
        $wxDate = $DomainWeiXin->getAll($openId);
        $Authorization = $DomainNintendoInterface->recur('accessToken', $wxDate);

        //判断$Authorization是否为空
        if ($Authorization != '') {
            //不为空则直接获取游戏记录
            $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($openId, $Authorization);
            //获取返回响应代码，用来判断相应是否成功
            $GetPlayHistoriesJsonCode = $DomainNintendoInterface->recur('code', $GetPlayHistoriesJson);
            if ($GetPlayHistoriesJsonCode != '') {
                //如果不为空，则代表获取数据失败，即$Authorization失效，这时候需要重新获取$Authorization
                $clientId = $DomainNintendoInterface->recur('clientId', $wxDate);
                $sessionToken = $DomainNintendoInterface->recur('sessionToken', $wxDate);
                //调用接口获取新$Authorization
                $PostAuthorization = $DomainNintendoInterface->PostAuthorization($clientId, $sessionToken, $openId);
                $Authorization = $DomainNintendoInterface->recur('access_token', $PostAuthorization);
                //使用新$Authorization获取游戏记录
                $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($openId, $Authorization);
            }
        } else {
            //如果为空，则需要获取$Authorization
            $clientId = $DomainNintendoInterface->recur('clientId', $wxDate);
            $sessionToken = $DomainNintendoInterface->recur('sessionToken', $wxDate);
            //调用接口获取$Authorization
            $PostAuthorization = $DomainNintendoInterface->PostAuthorization($clientId, $sessionToken, $openId);
            $accessToken = $DomainNintendoInterface->recur('access_token', $PostAuthorization);
            //使用$Authorization获取游戏记录
            $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($openId, $accessToken);
        }

        return $GetPlayHistoriesJson;
    }


}

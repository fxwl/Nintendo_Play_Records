<?php

namespace App\Domain\Nintendo;

use App\Domain\Nintendo\NintendoInterface as DomainNintendoInterface;
use App\Domain\WeiXin\WeiXin as DomainWeiXin;


class NintendoGURD
{

    public function GetPlayHistories($openid)
    {
        $DomainWeiXin = new  DomainWeiXin();
        $DomainNintendoInterface = new DomainNintendoInterface();

        $wxDate = $DomainWeiXin->getAll($openid);

        \PhalApi\DI()->logger->log('demo', 'add user exp', array('name' => $wxDate, 'after' => 12));

        $Authorization = $DomainNintendoInterface->recur('Authorization', $wxDate);

        \PhalApi\DI()->logger->log('demo', 'add user exp', array('name' => $Authorization, 'after' => 1));

        if ($Authorization != '') {

            $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($Authorization);

            \PhalApi\DI()->logger->log('demo', 'add user exp', array('$GetPlayHistoriesJson' => $GetPlayHistoriesJson, 'after' => 1));

            $GetPlayHistoriesJsonCode = $DomainNintendoInterface->recur('code', $GetPlayHistoriesJson);

            if ($GetPlayHistoriesJsonCode != '') {


                $GetPlayHistoriesJson = $this->getPlayHistoriesJson($DomainNintendoInterface, $wxDate);

            }

        } else {
            $GetPlayHistoriesJson = $this->getPlayHistoriesJson($DomainNintendoInterface, $wxDate);
        }

        return $GetPlayHistoriesJson;
    }

    /**
     * @param NintendoInterface $DomainNintendoInterface
     * @param $wxDate
     * @return mixed
     */
    public function getPlayHistoriesJson(NintendoInterface $DomainNintendoInterface, $wxDate)
    {
        $clientId = $DomainNintendoInterface->recur('client_id', $wxDate);
        $sessionToken = $DomainNintendoInterface->recur('session_token', $wxDate);

        \PhalApi\DI()->logger->log('demo', 'add user exp', array('$clientId' => $clientId, '$sessionToken' => $sessionToken));

        $PostAuthorization = $DomainNintendoInterface->PostAuthorization($clientId, $sessionToken);
        $PostAuthorizationJson = json_decode($PostAuthorization);

        \PhalApi\DI()->logger->log('demo', 'add user exp', array('$PostAuthorizationJson' => $PostAuthorizationJson, '$sessionToken' => $sessionToken));

        $Authorization = $DomainNintendoInterface->recur('access_token', $PostAuthorizationJson);

        \PhalApi\DI()->logger->log('demo', 'add user exp', array('$Authorization' => $Authorization, '$sessionToken' => $sessionToken));

        $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($Authorization);
        return $GetPlayHistoriesJson;
    }

}

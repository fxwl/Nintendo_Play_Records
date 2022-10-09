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

        $Authorization = $DomainNintendoInterface->recur('Authorization', $wxDate);

        $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($Authorization);

        $GetPlayHistoriesJsonCode = $DomainNintendoInterface->recur('code', $GetPlayHistoriesJson);

        if ($GetPlayHistoriesJsonCode != '') {


            $clientId = $DomainNintendoInterface->recur('client_id', $wxDate);
            $sessionToken = $DomainNintendoInterface->recur('session_token', $wxDate);

            $PostAuthorization = $DomainNintendoInterface->PostAuthorization($clientId, $sessionToken);
            $PostAuthorizationJson = json_decode($PostAuthorization);

            $Authorization = $DomainNintendoInterface->recur('access_token', $PostAuthorizationJson);

            $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($Authorization);

        }

        return $GetPlayHistoriesJson;
    }

}

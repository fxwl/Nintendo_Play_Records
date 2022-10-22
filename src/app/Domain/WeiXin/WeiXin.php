<?php

namespace App\Domain\WeiXin;

use App\Model\WeiXin\WeiXin as ModelWeiXin;

class WeiXin
{

    public function getAll($id)
    {
        $model = new ModelWeiXin();
        return $model->getAll($id);
    }

    public function updateAll($id, $accessToken, $idToken, $clientId, $sessionToken)
    {
        $model = new ModelWeiXin();
        return $model->updateAll($id, $accessToken, $idToken, $clientId, $sessionToken);
    }
}

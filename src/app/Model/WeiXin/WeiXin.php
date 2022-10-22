<?php

namespace App\Model\WeiXin;

use PhalApi\Model\NotORMModel as NotORM;


class WeiXin extends NotORM
{

    public function getAll($openid)
    {
        return $this->getORM()
            ->select('clientId', 'sessionToken', 'accessToken', 'idToken')
            ->where('openId', $openid)
            ->fetchAll();
    }

    public function updateAll($openid, $accessToken, $idToken, $clientId, $sessionToken)
    {
        $data = array(accessToken => $accessToken, idToken => $idToken, clientId => $clientId, sessionToken => $sessionToken);
        return $this->getORM()->where('openId', $openid)->update($data);
    }

    protected function getTableName($id)
    {
        return 'wx_user_id';
    }

}

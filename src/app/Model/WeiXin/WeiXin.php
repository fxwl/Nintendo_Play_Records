<?php

namespace App\Model\WeiXin;

use PhalApi\Model\NotORMModel as NotORM;


class WeiXin extends NotORM
{

    protected function getTableName($id)
    {
        return 'wx_user_id';
    }


    public function getAll($openid)
    {
        return $this->getORM()
            ->select('client_id', 'session_token', 'Authorization')
            ->where('id', $openid)
            ->fetchAll();
    }
}

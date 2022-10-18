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

    public function getAuthorization($openid)
    {
        // SELECT id, name FROM tbl_user WHERE (age > 18);
        $orm = $this->getORM()->select('Authorization')->where('id', $openid);

        while ($row = $orm->fetch('Authorization')) { // 指定获取的单个字段
            // 此时，输出的是一个字段值，而非一条数组纪录
            return var_dump($row);
        }
    }

    public function getClientId($openid)
    {
        // SELECT id, name FROM tbl_user WHERE (age > 18);
        $orm = $this->getORM()->select('client_id')->where('id', $openid);

        while ($row = $orm->fetch('client_id')) { // 指定获取的单个字段
            // 此时，输出的是一个字段值，而非一条数组纪录
            return var_dump($row);
        }
    }

    public function getSessionToken($openid)
    {
        // SELECT id, name FROM tbl_user WHERE (age > 18);
        $orm = $this->getORM()->select('session_token')->where('id', $openid);

        while ($row = $orm->fetch('session_token')) { // 指定获取的单个字段
            // 此时，输出的是一个字段值，而非一条数组纪录
            return var_dump($row);
        }
    }
}

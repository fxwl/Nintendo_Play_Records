<?php

namespace App\Model\WeiXin;

use PhalApi\Model\NotORMModel as NotORM;


class WeiXin extends NotORM
{

    protected function getTableName($id)
    {
        return 'wx_user_id';
    }

}

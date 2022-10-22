<?php

namespace App\Model\Nintendo;

use PhalApi\Model\NotORMModel as NotORM;


class NintendoPlayHistories extends NotORM
{

    public function fetchOne($titleId, $openId)
    {

        return $this->getORM()
            ->select('titleId', 'openId')
            ->where('$titleId', $titleId)
            ->where('openId', $openId)
            ->fetchOne();

    }

    public function insertMulti($rows)
    {
        $rows[id] = \PhalApi\Tool::createRandStr(32);
        return $this->getORM()->insert_multi($rows);
    }

    public function updateAll($openid, $titleId, $data)
    {
        $newArr = \PhalApi\Tool::arrayExcludeKeys($data, 'titleId,titleName,deviceType,imageUrl,openId');
        return $this->getORM()->where('openId', $openid)->where('titleId', $titleId)->update($newArr);
    }


    protected function getTableName($id)
    {
        return 'nintendo_play_histories';
    }

}

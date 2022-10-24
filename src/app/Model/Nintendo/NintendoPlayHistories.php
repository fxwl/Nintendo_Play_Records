<?php

namespace App\Model\Nintendo;

use PhalApi\Model\NotORMModel as NotORM;


class NintendoPlayHistories extends NotORM
{

    public function fetchOnePlayHistories($titleId, $openId)
    {

        return $this->getORM()
            ->select('titleId')
            ->where('titleId', $titleId)
            ->where('openId', $openId)
            ->fetchOne();

    }

    public function insertMultiPlayHistories($rows)
    {
        $rows['id'] = \PhalApi\Tool::createRandStr(32);
        return $this->getORM()->insert($rows);
    }

    public function updateAllPlayHistories($openid, $titleId, $data)
    {
        $newArr = \PhalApi\Tool::arrayExcludeKeys($data, 'titleId,titleName,deviceType,imageUrl,openId');
        return $this->getORM()->where('openId', $openid)->where('titleId', $titleId)->update($newArr);
    }

    protected function getTableName($id)
    {
        return 'nintendo_play_histories';
    }

}

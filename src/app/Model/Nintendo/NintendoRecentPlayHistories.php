<?php

namespace App\Model\Nintendo;

use PhalApi\Model\NotORMModel as NotORM;


class NintendoRecentPlayHistories extends NotORM
{

    public function fetchOneRecentPlayHistories($titleId, $openId, $playedDate)
    {

        return $this->getORM()
            ->select('titleId')
            ->where('titleId', $titleId)
            ->where('openId', $openId)
            ->where('playedDate', $playedDate)
            ->fetchOne();

    }

    public function insertMultiRecentPlayHistories($rows)
    {
        $rows['id'] = \PhalApi\Tool::createRandStr(32);
        return $this->getORM()->insert($rows);
    }

    public function updateAllRecentPlayHistories($openid, $titleId, $playedDate, $data)
    {
        $newArr = \PhalApi\Tool::arrayExcludeKeys($data, 'titleId,openId,playedDate');
        return $this->getORM()
            ->where('openId', $openid)
            ->where('titleId', $titleId)
            ->where('playedDate', $playedDate)
            ->update($newArr);
    }

    protected function getTableName($id)
    {
        return 'nintendo_recent_play_histories';
    }

}

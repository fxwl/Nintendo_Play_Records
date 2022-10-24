<?php

namespace App\Domain\Nintendo;

use App\Model\Nintendo\NintendoPlayHistories as ModelNintendoPlayHistories;
use App\Model\Nintendo\NintendoRecentPlayHistories as ModelNintendoRecentPlayHistories;

class NintendoGURD
{
    //游戏数据列表更新函数 NintendoPlayHistories
    //查询
    public function fetchOnePlayHistories($titleId, $openId)
    {
        $ModelNintendoPlayHistories = new ModelNintendoPlayHistories();
        return $ModelNintendoPlayHistories->fetchOnePlayHistories($titleId, $openId);
    }

    //插入
    public function insertMultiPlayHistories($rows)
    {
        $ModelNintendoPlayHistories = new ModelNintendoPlayHistories();
        return $ModelNintendoPlayHistories->insertMultiPlayHistories($rows);
    }

    //更新
    public function updateAllPlayHistories($openid, $titleId, $data)
    {
        $ModelNintendoPlayHistories = new ModelNintendoPlayHistories();
        return $ModelNintendoPlayHistories->updateAllPlayHistories($openid, $titleId, $data);
    }

    //每日游戏时长更新函数 NintendoRecentPlayHistories
    //查询
    public function fetchOneRecentPlayHistories($titleId, $openId, $playedDate)
    {
        $ModelNintendoRecentPlayHistories = new ModelNintendoRecentPlayHistories();
        return $ModelNintendoRecentPlayHistories->fetchOneRecentPlayHistories($titleId, $openId, $playedDate);
    }

    //插入
    public function insertMultiRecentPlayHistories($rows)
    {
        $ModelNintendoRecentPlayHistories = new ModelNintendoRecentPlayHistories();
        return $ModelNintendoRecentPlayHistories->insertMultiRecentPlayHistories($rows);
    }

    //更新
    public function updateAllRecentPlayHistories($openid, $titleId, $playedDate, $data)
    {
        $ModelNintendoRecentPlayHistories = new ModelNintendoRecentPlayHistories();
        return $ModelNintendoRecentPlayHistories->updateAllPlayHistories($openid, $titleId, $playedDate, $data);
    }

}

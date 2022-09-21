<?php

namespace App\Model\Nintendo;

use PhalApi\Model\NotORMModel as NotORM;


class NintendoPlayHistories extends NotORM
{

    protected function getTableName($id)
    {
        return 'nintendo_play_histories';
    }

}

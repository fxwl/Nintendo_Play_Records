<?php

namespace App\Model\Nintendo;

use PhalApi\Model\NotORMModel as NotORM;


class NintendoPlayHistoriesGameTitles extends NotORM
{

    protected function getTableName($id)
    {
        return 'nintendo_play_game_titles_info';
    }

}

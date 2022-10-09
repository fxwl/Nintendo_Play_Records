<?php

namespace App\Api\Nintendo;

use App\Domain\Nintendo\NintendoGURD as DomainNintendoGURD;
use PhalApi\Api;

/**
 * 任天堂游戏接口
 * @author dogstar 20170612
 */
class NintendoCURD extends Api
{

    public function getRules()
    {
        return array(
            'GetPlayHistories' => array(
                'openid' => array('name' => 'openid', 'require' => true, 'desc' => '标识码'),
            ),
        );
    }

    /**
     * 请求游戏数据
     * @desc 请求游戏数据
     * @return 游戏数据|array
     */
    public function GetPlayHistories()
    {
        $rs = array();

        $newData = $this->openid;

        $domain = new DomainNintendoGURD();
        $GetPlayHistoriesJson = $domain->GetPlayHistories($newData);

        return $GetPlayHistoriesJson;
    }

}

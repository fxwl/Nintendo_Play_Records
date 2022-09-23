<?php

namespace App\Domain\Nintendo;

use App\Model\Nintendo\NintendoPlayHistories as ModelNintendoPlayHistories;
use App\Model\Nintendo\NintendoPlayHistoriesGameTitles as ModelNintendoPlayHistoriesGameTitles;
use App\Domain\Nintendo\NintendoInterface as DomainNintendoInterface;

class NintendoGURD
{

    public function insert($code)
    {
        $wx = \PhalApi\DI()->wechatmini->getOpenid('$code');  //
        curl_close($wx);
        $DomainNintendoInterface = new DomainNintendoInterface();
        $model = new ModelNintendoPlayHistories();
        $client_id = $DomainNintendoInterface->recur('data.openid', $wx);
        $id = $model->delete($client_id);

        return $model->insert($newData);
    }

    public function update($id, $newData)
    {
        $model = new ModelCURD();
        return $model->update($id, $newData);
    }

    public function get($id)
    {
        $model = new ModelCURD();
        return $model->get($id);
    }

    public function delete($id)
    {
        $model = new ModelCURD();
        return $model->delete($id);
    }

    public function getList($state, $page, $perpage)
    {
        $rs = array('items' => array(), 'total' => 0);

        $model = new ModelCURD();
        $items = $model->getListItems($state, $page, $perpage);
        $total = $model->getListTotal($state);

        $rs['items'] = $items;
        $rs['total'] = $total;

        return $rs;
    }
}

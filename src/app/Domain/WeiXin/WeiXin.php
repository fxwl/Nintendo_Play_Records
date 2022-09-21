<?php

namespace App\Domain\WeiXin;

use App\Model\WeiXin\WeiXin as ModelWeiXin;

class WeiXin
{

    public function insert($newData)
    {
        $model = new ModelWeiXin();
        return $model->insert($newData);
    }

    public function update($id, $newData)
    {
        $model = new ModelWeiXin();
        return $model->update($id, $newData);
    }

    public function get($id)
    {
        $model = new ModelWeiXin();
        return $model->get($id);
    }

    public function delete($id)
    {
        $model = new ModelWeiXin();
        return $model->delete($id);
    }

    public function getList($state, $page, $perpage)
    {
        $rs = array('items' => array(), 'total' => 0);

        $model = new ModelWeiXin();
        $items = $model->getListItems($state, $page, $perpage);
        $total = $model->getListTotal($state);

        $rs['items'] = $items;
        $rs['total'] = $total;

        return $rs;
    }
}

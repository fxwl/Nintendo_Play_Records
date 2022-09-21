<?php

namespace App\Api\WeiXin;

use App\Domain\WeiXin\WeiXin as DomainWeiXin;
use PhalApi\Api;

/**
 * 微信数据存储
 * @author dogstar 20170612
 */
class WeiXin extends Api
{

    public function getRules()
    {
        return array(
            'insert' => array(
                'id' => array('name' => 'id', 'require' => true, 'desc' => '微信用户ID'),
                'user_name' => array('name' => 'user_name', 'require' => true, 'desc' => '微信用户名'),
                'client_id' => array('name' => 'client_id', 'desc' => '任天堂app识别码'),
                'session_token' => array('name' => 'session_token', 'desc' => '任天堂token'),
                'Authorization' => array('name' => 'Authorization', 'desc' => '密钥'),
            ),
            'update' => array(
                'id' => array('name' => 'id', 'require' => true, 'desc' => '微信用户ID'),
                'user_name' => array('name' => 'user_name', 'require' => true, 'desc' => '微信用户名'),
                'client_id' => array('name' => 'client_id', 'desc' => '任天堂app识别码'),
                'session_token' => array('name' => 'session_token', 'desc' => '任天堂token'),
                'Authorization' => array('name' => 'Authorization', 'desc' => '密钥'),
            ),
            'get' => array(
                'id' => array('name' => 'id', 'require' => true, 'desc' => '微信用户ID'),
            ),
            'delete' => array(
                'id' => array('name' => 'id', 'require' => true, 'desc' => '微信用户ID'),
            ),
        );
    }

    /**
     * 新增微信用户
     * @desc 新增微信用户
     * @return int id 新增的UID
     */
    public function insert()
    {
        $rs = array();

        $newData = array(
            'id' => $this->id,
            'user_name' => $this->user_name,
            'client_id' => $this->client_id,
            'session_token' => $this->session_token,
            'Authorization' => $this->Authorization,
        );

        $domain = new DomainWeiXin();
        $id = $domain->insert($newData);

        $rs['id'] = $id;
        return $rs;
    }

    /**
     * 更新数据
     * @desc 更新微信用户的密钥数据
     * @method POST
     * @return int code 更新的结果，1表示成功，0表示无更新，false表示失败
     */
    public function update()
    {
        $rs = array();

        $newData = array(
            'id' => $this->id,
            'user_name' => $this->user_name,
            'client_id' => $this->client_id,
            'session_token' => $this->session_token,
            'Authorization' => $this->Authorization,
        );

        $domain = new DomainWeiXin();
        $code = $domain->update($this->id, $newData);

        $rs['code'] = $code;
        return $rs;
    }

    /**
     * 获取数据
     * @desc 获取用户的密钥
     * @method GET
     * @return int      id          主键id
     * @return string   title       标题
     * @return string   content     内容
     * @return int      state       状态
     * @return string   post_date   发布日期
     */
    public function get()
    {
        $domain = new DomainWeiXin();
        $data = $domain->get($this->id);

        return $data;
    }

    /**
     * 删除数据
     * @desc 删除用户的数据
     * @return int code 删除的结果，1表示成功，0表示失败
     */
    public function delete()
    {
        $rs = array();

        $domain = new DomainWeiXin();
        $code = $domain->delete($this->id);

        $rs['code'] = $code;
        return $rs;
    }

}

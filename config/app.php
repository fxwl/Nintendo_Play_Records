<?php
/**
 * 请在下面放置任何您需要的应用配置
 *
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author dogstar <chanzonghuang@gmail.com> 2017-07-13
 */

return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(//'sign' => array('name' => 'sign', 'require' => true),
    ),
    //微信小程序注册
    'Wechatmini' => array(
        'appid' => 'wxf53821909723fe10',
        'secret_key' => 'de5f69e8b6c94e20a8f032e805805175',
        'mch_id' => '商户号',//不用支付可以不用配置
        'mch_key' => '支付秘钥',//不用支付可以不用配置
    ),

    /**
     * 接口服务白名单，格式：接口服务类名.接口服务方法名
     *
     * 示例：
     * - *.*         通配，全部接口服务，慎用！
     * - Site.*      Api_Default接口类的全部方法
     * - *.Index     全部接口类的Index方法
     * - Site.Index  指定某个接口服务，即Api_Default::Index()
     */
    'service_whitelist' => array(
        'Site.Index',
    ),
    
);



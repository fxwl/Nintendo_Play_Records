<?php
return array(
    //所有参数规则列表,require参数在调用时可以额外指定.
    'param1' => array('type' => 'string', 'require' => 1, 'max' => 64, 'desc' => '参数1的说明'),
    'param2' => array('type' => 'int', 'require' => 0, 'default' => '', 'desc' => '参数2的说明'),
    'param3' => array('type' => 'array','require' => 0, 'desc' => '参数3的说明'),
);
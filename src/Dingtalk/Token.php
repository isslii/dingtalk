<?php
// +------------------------------------------------+
// |http://www.cjango.com                           |
// +------------------------------------------------+
// | 修复BUG不是一朝一夕的事情，等我喝醉了再说吧！  |
// +------------------------------------------------+
// | Author: 小陈叔叔 <Jason.Chen>                  |
// +------------------------------------------------+
namespace cjango\Dingtalk;

use cjango\Dingtalk;

/**
 * Token 获取
 */
class Token extends Dingtalk
{

    /**
     * 获取ACCESS_TOKEN
     * @return string
     */
    public function get()
    {
        $params = [
            'corpid'     => parent::$config['corpid'],
            'corpsecret' => parent::$config['corpsecret'],
        ];

        $result = Utils::api('gettoken', $params);
        return self::$result['access_token'];
    }

    public function jsapi()
    {
        #Todo..
    }
}

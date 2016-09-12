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
     * @return string|boolean
     */
    public static function get()
    {
        $params = [
            'corpid'     => parent::$config['corpid'],
            'corpsecret' => parent::$config['corpsecret'],
        ];

        $result = Utils::api('gettoken', $params);
        if (false !== $result) {
            return $result['access_token'];
        } else {
            return false;
        }
    }

    /**
     * 获取 免登SsoToken
     * @return string|boolean
     */
    public static function sso()
    {
        $params = [
            'corpid'     => parent::$config['corpid'],
            'corpsecret' => parent::$config['ssosecret'],
        ];

        $result = Utils::api('sso/gettoken', $params);
        if (false !== $result) {
            return $result['access_token'];
        } else {
            return false;
        }
    }

    /**
     * 获取jsapi_ticket
     * @return string|boolean
     */
    public static function jsapi()
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = self::get();
        }

        $params = [
            'access_token' => $access_token,
        ];

        $result = Utils::api('get_jsapi_ticket', $params);
        if (false !== $result) {
            return $result['ticket'];
        } else {
            return false;
        }
    }
}

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
 * 会话消息
 */
class Message extends Dingtalk
{
    /**
     * 发送企业会话消息
     */
    public static function send($touser, $agentid, $msgtype, $msgbody)
    {
        $params = [
            'touser'  => '',
            'agentid' => $agentid,
            'msgtype' => $msgtype,
            $msgbody,
        ];

        $result = Utils::post('message/send', $params);

        if (false !== $result) {
            unset($result['errcode']);
            unset($result['errmsg']);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 获取企业会话消息已读未读状态
     * @param  string $messageId 消息id
     * @return array|boolean
     */
    public static function status($messageId)
    {
        $params = [
            'messageId' => $messageId,
        ];

        $result = Utils::post('message/list_message_status', $params);

        if (false !== $result) {
            unset($result['errcode']);
            unset($result['errmsg']);
            return $result;
        } else {
            return false;
        }
    }
}

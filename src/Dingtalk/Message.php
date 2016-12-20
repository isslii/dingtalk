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
     * @param  [type] $touser  [description]
     * @param  [type] $agentid [description]
     * @param  [type] $msgtype [description]
     * @param  [type] $msgbody [description]
     * @return [type]          [description]
     */
    public static function send($touser, $agentid, $msgtype, $msgbody)
    {
        $params = [
            'touser'  => $touser,
            'agentid' => $agentid,
            'msgtype' => $msgtype,
            $msgtype => $msgbody,
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

    /**
     * 发送普通会话消息
     * @param  [type] $sender  [description]
     * @param  [type] $cid     [description]
     * @param  [type] $msgtype [description]
     * @param  [type] $msgbody [description]
     * @return [type]          [description]
     */
    public static function common($sender, $cid, $msgtype, $msgbody)
    {
        $params = [
            'sender'  => $sender,
            'cid'     => $cid,
            'msgtype' => $msgtype,
            $msgbody,
        ];

        $result = Utils::post('message/send_to_conversation', $params);

        if (false !== $result) {
            return $result['receiver'];
        } else {
            return false;
        }
    }
}

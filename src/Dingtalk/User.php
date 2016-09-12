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
 * 用户管理
 */
class User extends Dingtalk
{
    /**
     * 获取用户详情
     * @param  string $userid 员工在企业内的UserID
     * @return array|boolean
     */
    public static function get($userid)
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'userid'       => $userid,
            'access_token' => $access_token,
        ];

        $result = Utils::api('user/get', $params);
        if (false !== $result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 创建成员
     * @param  [type] $name       [description]
     * @param  string $mobile     [description]
     * @param  array  $department [description]
     * @return [type]             [description]
     */
    public static function create($name, $mobile, $department = [])
    {
        $params = [
            'name'       => $name,
            'mobile'     => $mobile,
            'department' => $department,
        ];

        $params = json_encode($params, JSON_UNESCAPED_UNICODE);

        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $result = Utils::api('user/create?access_token=' . $access_token, $params, 'POST');
        if (false !== $result) {
            return $result['id'];
        } else {
            return false;
        }
    }

    /**
     * 更新成员
     * @param  [type] $userid [description]
     * @param  [type] $name   [description]
     * @param  array  $data   [description]
     * @return [type]         [description]
     */
    public static function update($userid, $name, $data = [])
    {
        #Todo..
    }

    /**
     * 删除成员
     * @param  [type] $userid [description]
     * @return [type]         [description]
     */
    public static function delete($userid)
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'userid'       => $userid,
            'access_token' => $access_token,
        ];

        $result = Utils::api('user/delete', $params);
        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * [batchDelete description]
     * @param  array  $useridlist
     * @return boolean
     */
    public static function batchDelete($useridlist = [])
    {
        $params = [
            'useridlist' => $useridlist,
        ];

        $params = json_encode($params, JSON_UNESCAPED_UNICODE);

        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $result = Utils::api('user/batchdelete?access_token=' . $access_token, $params, 'POST');
        if (false !== $result) {
            return $result['id'];
        } else {
            return false;
        }
    }
    /**
     * 获取管理员列表
     * @return array|boolean
     */
    public static function admin()
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'access_token' => $access_token,
        ];

        $result = Utils::api('user/get_admin', $params);
        if (false !== $result) {
            return $result['adminList'];
        } else {
            return false;
        }
    }
}

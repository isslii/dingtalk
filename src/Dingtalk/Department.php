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
 * Department 通讯录管理
 */
class Department extends Dingtalk
{

    /**
     * 获取部门列表
     * @return array|boolean
     */
    public static function lists()
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'access_token' => $access_token,
        ];

        $result = Utils::api('department/list', $params);
        if (false !== $result) {
            return $result['department'];
        } else {
            return false;
        }
    }

    /**
     * 获取部门详情
     * @param  integer $id 部门ID
     * @return array|boolean
     */
    public static function info($id)
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'id'           => $id,
            'access_token' => $access_token,
        ];

        $result = Utils::api('department/get', $params);
        if (false !== $result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 创建部门
     * @param  string|array $name
     * @param  integer      $parentid
     * @return integer|boolean
     */
    public static function create($name, $parentid = 1)
    {
        if (is_array($name)) {
            $params = $name;
        } else {
            $params = [
                'name'     => $name,
                'parentid' => $parentid,
            ];
        }

        $params = json_encode($params, JSON_UNESCAPED_UNICODE);

        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $result = Utils::api('department/create?access_token=' . $access_token, $params, 'POST');
        if (false !== $result) {
            return $result['id'];
        } else {
            return false;
        }
    }

    /**
     * 更新部门
     * @param  string|array $name
     * @param  integer      $id
     * @return boolean
     */
    public static function update($name, $id)
    {
        if (is_array($name)) {
            $params = $name;
        } else {
            $params = [
                'id'   => $id,
                'name' => $name,
            ];
        }

        $params = json_encode($params, JSON_UNESCAPED_UNICODE);

        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $result = Utils::api('department/update?access_token=' . $access_token, $params, 'POST');
        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除部门
     * @param  integer      $id
     * @return boolean
     */
    public static function delete($id)
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'id'           => $id,
            'access_token' => $access_token,
        ];

        $result = Utils::api('department/delete', $params);
        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    public static function users($departmentId)
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'department_id' => $departmentId,
            'access_token'  => $access_token,
        ];

        $result = Utils::api('user/simplelist', $params);
        if (false !== $result) {
            return $result['userlist'];
        } else {
            return false;
        }
    }

    public static function usersDetail($departmentId)
    {
        $access_token = parent::$config['access_token'];
        if (empty($access_token)) {
            $access_token = Token::get();
        }

        $params = [
            'department_id' => $departmentId,
            'access_token'  => $access_token,
        ];

        $result = Utils::api('user/list', $params);
        if (false !== $result) {
            return $result['userlist'];
        } else {
            return false;
        }
    }
}

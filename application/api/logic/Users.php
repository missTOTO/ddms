<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-15
 * Time: 15:02
 */

namespace app\api\logic;
use app\api\validate\User;
class Users
{
	/**
	 * 获取用户信息
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
    public function userInfo($id)
    {
    	$data = Model('Users')->get($id);
    	if (empty($data)) {
    		return $data;
    	} else {
    		abort('404','用户不存在');
    	}
    }
    /**
     * 更新用户信息
     * @param  [type] $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function updateUserInfo($data, $id)
    {
    	$Users = Model('Users');
    	$result = $Users->validate(true)->isUpdate(true)->save($data, ['id' => $id]);
    	if (false === $result) {
    		return $Users->getError();
    	} else {
    		return $result;
    	}
    }
    /**
     * [createNewUser description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function createNewUser($data)
    {
    	
    }
}
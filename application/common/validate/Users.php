<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-20
 * Time: 18:27
 */

namespace app\common\validate;

use think\Validate;

class Users extends Validate
{
    protected $rule = [
    	'name'	=>	'require|max:4|unique:users',
    	'phone'	=>	'/^1[345678]{1}\d{9}$/'
    ];

    protected $message = [
    	'name.require'	=>	'名称必须',
    	'name.max'		=>	'名称最多不能超过4个字符',
    	'phone'			=>	'手机号不符合规范'

    ];
}
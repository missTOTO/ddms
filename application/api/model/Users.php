<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-14
 * Time: 16:00
 */

namespace app\api\model;

use think\Model;

class Users extends Model
{
	protected $field = ['id', 'name', 'phone', 'sex', 'birthday', 'city', 'school', 'hobby'];
}
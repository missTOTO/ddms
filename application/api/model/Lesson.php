<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-16
 * Time: 18:07
 */

namespace app\api\model;

use think\Model;

class Lesson extends Model
{
	protected $field = ['id', 'user_id', 'title', 'img_url', 'learn_num', 'introduction', 'is_use',];

}
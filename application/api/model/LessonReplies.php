<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-17
 * Time: 17:21
 */

namespace app\api\model;

use think\Model;

class LessonReplies extends Model
{
	protected $field = ['id', 'lesson_catalog_id', 'user_id', 'content', 'praise_count', 'create_at', 'update_at'];
}
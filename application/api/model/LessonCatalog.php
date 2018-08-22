<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-17
 * Time: 10:34
 */

namespace app\api\model;
use traits\model\SoftDelete;
use think\Model;

class LessonCatalog extends Model
{
	use SoftDelete;
	protected $filed = ['id', 'lesson_id', 'title', 'img_url', 'video_url', 'introduction', 'reply_count', 'view_count', 'praise_count', 'delete_at'];
	protected $deleteTime = 'delete_at';
    //protected $defaultSoftDelete = time();
    protected $type = [
        'delete_at'    =>  'datetime',
    ];
}
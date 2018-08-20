<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-17
 * Time: 17:22
 */

namespace app\api\logic;


class LessonReplies
{
	/**
	 * 评论列表
	 * @param  [type] $catelog_id [description]
	 * @return [type]             [description]
	 */
	public function repliesList($catelog_id)
	{
		$data = Model('LessonReplies')->all();
		if (!empty($data)) {
			return $data;
		}
		abort('404','没有可用数据');
	}

	/**
	 * 创建评论
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function createReplies($data)
	{
		$data = Model('LessonReplies')->save($data);
		if (!empty($data)) {
			return $data;
		}
		abort('403','保存失败');
	}
}
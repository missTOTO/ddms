<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-17
 * Time: 10:23
 */

namespace app\api\logic;


class Lesson
{
	/**
	 * 获取课程列表
	 * @return [type] [description]
	 */
	function lessonList()
	{
		$data = Model('Lesson')->field(['id', 'title', 'img_url'])
							->select();
		if (!empty($data)) {
			return $data;
		}
		abort('404','没有可用数据');
	}
	/**
	 * 获取课程详情
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function lessonInfo($id)
	{
		$data = Model('Lesson')->get($id);
		if (!empty($data)) {
			return $data;
		}
		abort('404','没有可用数据');
	}
}
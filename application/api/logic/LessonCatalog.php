<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-17
 * Time: 10:33
 */

namespace app\api\logic;


class LessonCatalog
{
	/**
	 * 课程目录
	 * @param  [type] $lesson_id [description]
	 * @return [type]            [description]
	 */
	public function lessonCatalogList($lesson_id)
	{
		$data = Model('LessonCatalog')->where('lesson_id', $lesson_id)
									->field(['title','img_url'])
									->select();
		if (!empty($data)) {
			return $data;
		}
		abort('404','没有可用数据');
	}
	/**
	 * 课程内容
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function lessonContent($id)
	{
		$lessonCatalog = Model('LessonCatalog');
		$data = $lessonCatalog->get($id);
		if (!empty($data)) {
			$lessonCatalog->where('id', $id)->setInc('view_count');
			return $data;
		}
		abort('404','没有可用数据');
	}
}
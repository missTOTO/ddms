<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-08-16
 * Time: 17:51
 */

namespace app\api\controller\v1;

use think\Request;
class Lesson
{
	//获取课程列表
	public function index()
	{
		$result = Model('Lesson','logic')->lessonList();
        return json($result);
	}

	//查看课程详情
	public function read($id)
	{
		$result = Model('Lesson','logic')->lessonInfo($id);
        return json($result);
	}

	/**
	 * 课程目录
	 * @param  [type] $lesson_id [description]
	 * @return [type]            [description]
	 */
    public function catalog($lesson_id)
    {
    	$result = Model('LessonCatalog','logic')->lessonCatalogList($lesson_id);
        return json($result);
    }

    /**
     * 课程内容
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function content($catelog_id)
    {
    	$result = Model('LessonCatalog','logic')->lessonContent($catelog_id);
        return json($result);
    }

    /**
     * 评论
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function replies($catelog_id)
    {
    	$result = Model('LessonReplies','logic')->repliesList($catelog_id);
        return json($result);
    }
    
    /**
     * 提交评论
     * @param  Request $request    [description]
     * @param  [type]  $catelog_id [description]
     * @return [type]              [description]
     */
    public function submitReplies(Request $request)
    {	
    	$data = $request->param();
    	$result = Model('LessonReplies','logic')->createReplies($data);
        return json($result);
    }
    
    public function delete($id)
    {
        $result = Model('LessonCatalog')->destroy($id);
        return json($result);
    }
}
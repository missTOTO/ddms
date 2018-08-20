<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::group('api/:version', function(){
	//用户
	Route::group('users', function(){
		Route::resource('/','api/:version.Users');
		//修改用户头像
		Route::post(':id/head','api/:version.Users/head');
	});
	//课程
	Route::group('lessons', function(){
		Route::resource('/','api/:version.Lesson');
		//课程目录
		Route::get(':lesson_id/catalogs','api/:version.Lesson/catalog');
		//课程内容
		Route::get('catalogs/:catelog_id$','api/:version.Lesson/content');
		//评论列表
		Route::get('catalogs/:catelog_id/replies','api/:version.Lesson/replies');
		//保存评论
		Route::post('catalogs/replies','api/:version.Lesson/submitReplies');
		
	});
	//验证码
	Route::resource('verificationCodes','api/:version.VerificationCodes');
});

return [
	//定义资源路由
	'__rest__' =>[
	
	],

	//定义普通路由
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ], 
	//设置全局变量规则
    '__pattern__' => [
        'name' => '\w+',
    ],
   
];

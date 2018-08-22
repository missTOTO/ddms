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

Route::group(['name' => 'api/:version', 'prefix' => 'api/:version'], function(){
	//用户
	Route::group(['name' => 'users'], function(){
		Route::resource('/', '.Users');
		//修改用户头像
		Route::post(':id/head', '.Users/head');
	});
	//课程
	Route::group(['name'=>'lessons'], function(){
		Route::resource('/','.Lesson');
		//课程目录
		Route::get(':lesson_id/catalogs','.Lesson/catalog');
		//课程内容
		Route::get('catalogs/:catelog_id$','.Lesson/content');
		//评论列表
		Route::get('catalogs/:catelog_id/replies','.Lesson/replies');
		//保存评论
		Route::post('catalogs/replies','.Lesson/submitReplies');
		
	});
	//验证码
	Route::resource('verificationCodes','.VerificationCodes', ['var'=>['verificationCodes'=>'verification_key']]);
});

/*return [
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
   
];*/

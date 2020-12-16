<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function() {
//后台登录
Route::get('login', 'LoginController@login');
Route::post('dologin', 'LoginController@doLogin');
//生成验证码（code）
// Route::get('code', 'LoginController@code');

});
//生成验证验证码
Route::get('code/captcha/{tmp}', 'Admin\LoginController@captcha');

Route::get('ji','Admin\LoginController@jisuan');

//无权限页面
Route::get('noaccess','Admin\LoginController@noaccess');

// 教师界面
Route::group(['prefix'=>'teacher', 'namespace'=>'Admin', 'middleware'=>['islogin']], function() {
Route::get('index','LoginController@tindex');

});

// 学生界面
Route::group(['prefix'=>'student', 'namespace'=>'Admin', 'middleware'=>['islogin']], function() {
Route::get('index','LoginController@sindex');

});

//设置权限，必须登录才能访问，中间件的使用    'hasrole':shadiao权限设置
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['islogin']], function() {
//后台首页
Route::get('index','LoginController@index');
//欢迎
Route::get('welcome', 'LoginController@welcome');
//退出
Route::get('logout', 'LoginController@logout');


//    后台用户模块相关路由
//    给用户授权相关路由
Route::get('user/auth/{id}','UserController@auth');
Route::post('user/doauth','UserController@doAuth');
//批量删除
Route::get('user/del', 'UserController@delAll');
//资源型路由
Route::resource('user','UserController');

// 教师信息
Route::get('teacher',"TeacherController@toteacher");
Route::get('teacher/add',"TeacherController@teachertoadd");
Route::post('teacher/store',"TeacherController@tea_store");
Route::get('teacher/edit',"TeacherController@teachertoedit");
Route::post('teacher/update',"TeacherController@tea_update");
Route::get('teacher/destroy',"TeacherController@tea_destroy");
Route::get('teacher/del', 'TeacherController@delAll');

// 学生信息
Route::get('student',"StudentController@tostudent");
Route::get('student/add',"StudentController@studenttoadd");
Route::post('student/store',"StudentController@stu_store");
Route::get('student/edit',"StudentController@studenttoedit");
Route::post('student/update',"StudentController@stu_update");
Route::get('student/destroy',"StudentController@stu_destroy");
Route::get('student/del', 'StudentController@delAll');

// 课程信息
Route::get('course',"CourseController@tocourse");
Route::get('course/add',"CourseController@coursetoadd");
Route::post('course/store',"CourseController@cou_store");
Route::get('course/edit',"CourseController@coursetoedit");
Route::post('course/update',"CourseController@cou_update");
Route::get('course/destroy',"CourseController@cou_destroy");
Route::get('course/del', 'CourseController@delAll');

// 成绩信息
Route::get('score',"ScoreController@toscore");
Route::get('score/add',"ScoreController@scoretoadd");
Route::post('score/store',"ScoreController@sco_store");
Route::get('score/edit',"ScoreController@scoretoedit");
Route::post('score/update',"ScoreController@sco_update");
Route::get('score/destroy',"ScoreController@sco_destroy");
Route::get('score/del', 'ScoreController@delAll');

// 我的设置
Route::get('user_mes',"UserController@tousermes");
Route::get('user_edit',"UserController@toedit");
Route::get('usertopwd',"UserController@topwd");
Route::post('user_pwd',"UserController@userpwd");

// Excel导入导出
Route::get('excel/export','ExcelController@export');
Route::get('excel/import','ExcelController@import');


// //角色模块
// //角色授权路由
// Route::get('role/auth/{id}', 'RoleController@auth');
// //处理授权
// Route::post('role/doauth', 'RoleController@doAuth');
// //批量删除
// Route::get('role/del', 'RoleController@delAll');
// //资源型路由
// Route::resource('role', 'RoleController');


// //权限模块
// //批量删除
// Route::get('permission/del', 'PermissionController@delAll');
// Route::resource('permission', 'PermissionController');

// //分类模块
// //修改排序
// Route::post('cate/changeorder','CateController@changeOrder');
// Route::resource('cate', 'CateController');

// //文章模块
// //    文章添加到推荐位路由
// Route::get('article/recommend','ArticleController@recommend');
// //将markdown语法的内容转化为HTML语法内容
// Route::post('article/pre_mk','ArticleController@pre_mk');
// //上传路由
// Route::post('article/upload','ArticleController@upload');
// Route::resource('article','ArticleController');

//网站配置模块
Route::post('config/changecontent','ConfigController@changeContent');
Route::get('config/putcontent','ConfigController@putContent');
Route::resource('config','ConfigController');

});



 





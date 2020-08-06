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

Route::get('/', function () {
    return view('welcome');
});

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


//角色模块
//角色授权路由
Route::get('role/auth/{id}', 'RoleController@auth');
//处理授权
Route::post('role/doauth', 'RoleController@doAuth');
//批量删除
Route::get('role/del', 'RoleController@delAll');
//资源型路由
Route::resource('role', 'RoleController');


//权限模块
//批量删除
Route::get('permission/del', 'PermissionController@delAll');
Route::resource('permission', 'PermissionController');

//分类模块
//修改排序
Route::post('cate/changeorder','CateController@changeOrder');
Route::resource('cate', 'CateController');

//文章模块
//将markdown语法的内容转化为HTML语法内容
Route::post('article/pre_mk','ArticleController@pre_mk');
//上传路由
Route::post('article/upload','ArticleController@upload');
Route::resource('article','ArticleController');
});



 





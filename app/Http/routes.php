<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//博客前台路由
Route::get('/','Home\IndexController@index');
Route::get('/cate/{cate_id}','Home\IndexController@cate');
Route::get('/art/{art_id}','Home\IndexController@article');

//Route::get('admin/getcode','Admin\LoginController@getcode');
//Route::get('admin/crypt','Admin\LoginController@crypt');




Route::any('admin/login','Admin\LoginController@login');//登录页面
Route::get('admin/code','Admin\LoginController@code');//验证码

Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function (){
//    Route::any('admin/index','Admin\IndexController@index');//后台主页
//    Route::any('admin/info','Admin\IndexController@info');//info页面
//    Route::any('admin/quit','Admin\LoginController@quit');//info页面

    Route::get('index','IndexController@index');//后台主页
    Route::get('info','IndexController@info');//info页面
    Route::get('quit','LoginController@quit');//info页面
    Route::any('pass','IndexController@pass');//修改密码页面
    Route::resource('category','CategoryController');//分类资源路由
    Route::post('cate/changeOrder','CategoryController@changeOrder');//修改分类排序

    Route::resource('article','ArticleController');//文章资源路由
    Route::any('upload','CommonController@upload');//文件上传路由

    Route::resource('links','LinksController');//友情链接资源路由
    Route::post('link/changeOrder','LinksController@changeOrder');//修改友情链接排序

    Route::resource('navs','NavController');//自定义导航资源路由
    Route::post('nav/changeOrder','NavController@changeOrder');//修改自定义导航排序

    Route::get('config/putFile','ConfigController@putFile');//修改配置项内容
    Route::resource('config','ConfigController');//配置项资源路由
    Route::post('config/changeOrder','ConfigController@changeOrder');//修改配置项排序
    Route::post('config/changeContent','ConfigController@changeContent');//修改配置项内容

});
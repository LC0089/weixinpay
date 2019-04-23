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

/*微信*/
//Route::get('index', 'Weixin\WxController@index');
//Route::any('index', 'Weixin\WxController@event');
//Route::any('event', 'Weixin\WxController@event');
//Route::get('token', 'Weixin\WxController@token');
//Route::get('getuser', 'Weixin\WxController@getuser');
//Route::post('menu2', 'Weixin\WxController@menu2');

//项目
Route::get('index', 'Index\IndexController@index');
Route::any('add/{goods_id?}', 'Index\IndexController@add');
Route::any('goods_detail/{goods_id?}', 'Index\IndexController@goods_detail');
Route::any('lis', 'Index\IndexController@lis');
Route::any('history', 'Index\IndexController@history');


Route::get('cart', 'Cart\CartController@cart');

Route::get('create', 'Order\OrderController@create');
Route::get('lists', 'Order\OrderController@lists');
Route::get('paystatus', 'Order\OrderController@paystatus');
Route::get('success', 'Order\OrderController@success');

//微信支付
Route::get('test/{order_id?}','Weixin\WxPayController@test');           //支付
Route::any('notify','Weixin\WxPayController@notify');       //微信支付回调地址
Route::any('jssdk','Weixin\JssdkController@jssdk');
Route::any('getImg','Weixin\JssdkController@getImg');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

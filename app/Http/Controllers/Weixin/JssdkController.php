<?php
namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class JssdkController extends Controller
{
    //

    public function jssdk(){
//        print_r($_SERVER);die;
        $jsapi_ticket = JsapiTicket();
//        print_r($jsapi_ticket);die;
        $nonceStr = Str::random(10);
        $timestamp = time();
        $current_cul = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $string1 = "jsapi_ticket=$jsapi_ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$current_cul";
        $sign = sha1($string1);

        $js_config = [
            'appId'=>env('WX_APPID'), //公众号IP
            'timestamp'=>$timestamp,
            'nonceStr'=>$nonceStr,  //随机字符串
            'signature'=>$sign,  //签名
            'jsApiList'=>['chooseImage'],  //要使用的表功能
        ];
        $data = [
            'config'=>$js_config
        ];
        return view('weixin.jssdk',$data);

    }
}
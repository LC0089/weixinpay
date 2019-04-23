<?php
namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class JssdkController extends Controller
{
    //

    public function jssdk(){
        $jsapi_ticket = JsapiTicket();
        $nonceStr = Str::random(10);
        $timestamp = time();
        $current_cul = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $string1 = "jsapi_ticket=$jsapi_ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$current_cul";
//        print_r($string1);die;
        $sign = sha1($string1);
//        dump($sign);die;
        $js_config = [
            'appId'=>env('WX_APPID'), //公众号IP
            'timestamp'=>$timestamp,
            'nonceStr'=>$nonceStr,  //随机字符串
            'signature'=>$sign,  //签名
//            'jsApiList'=>['chooseImage'],  //要使用的表功能
        ];
        $data = [
            'config'=>$js_config
        ];
//        print_r($data);die;
        return view('weixin.jssdk',$data);
    }

    public function getImg(){
        print_r($_GET);
//        $img = $_GET;
//        $file_name = rtrim(substr("QAZWSXEDCRFVTGBYHNUJMIKMOLqwertyuiopasdfghjklzxcvbnmP", -10), '"').".jpg";//取文件名后10位
//        $img_name =  substr(md5(time() . mt_rand()), 10, 8) . '_' . $file_name;//最后的文件名;
//        file_put_contents("/tmp/$img_name",$img,FILE_APPEND);
    }
}
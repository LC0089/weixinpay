<?php
/**
 * Created by PhpStorm.
 * User: 。。。
 * Date: 2019/4/23
 * Time: 16:16
 */
use Illuminate\Support\Facades\Redis;
 function test(){
    echo 'Helper';
}

function accessToken()
{
    $key = 'wx_access_token';
    $accessToken = Redis::get($key);
    if ($accessToken) {
        return $accessToken;
    } else {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . env('WX_APPID') . '&secret=' . env('WX_SECRET') . '';
        $response = json_decode(file_get_contents($url),true);
        if(isset($response['access_token'])){
            Redis::set($key, $response['access_token']);
            Redis::expire($key, 3600);
            return $response['access_token'];
        }else{
            return false;
        }

    }
}
function JsapiTicket(){
    $key = 'wx_jsapi_ticket';
    $jsapi_ticket = Redis::get($key);
    if($jsapi_ticket){
        return $jsapi_ticket;
    }else{
        $accessToken = accessToken();
        $url ="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi";
        $jsapi_ticket =json_decode(file_get_contents($url),true);

        if(isset($jsapi_ticket['ticket'])){
            Redis::set($key, $jsapi_ticket['ticket']);
            Redis::expire($key, 3600);
            return $jsapi_ticket['ticket'];
        }else{
            return false;
        }
    }

}
?>
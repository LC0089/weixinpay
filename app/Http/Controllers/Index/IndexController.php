<?php

namespace App\Http\Controllers\Index;

use App\Model\CartModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    /*
     * 商品展示
     * */
    public function index(){

        $arr = GoodsModel::where('goods_up',1)->get();

        return view('index.index',['arr'=>$arr]);
    }
    /**
     * @param $goods_id
     * 商品详情
     */
    public function goods_detail($goods_id){
        $arr = GoodsModel::where('goods_id',$goods_id)->first()->toArray();
        $goods_name = $arr['goods_name'];
        if($arr == NULL){
            header("Refresh:3;url=index");
            echo "该商品不存在，请重新选择商品";
            die;
        }
        $redis_look_num = 'count:view:goods_id:'.$goods_id;//浏览量
        $redis_pk_view = 'pk:goods:view';  //排序
        $view = Redis::incr($redis_look_num);
        Redis::zAdd($redis_pk_view,$view,$goods_id);

        $arr['look_num'] = $view;
        $good_data = [
            'look_num'=>$view
        ];
//        print_r($goods_id);die;
        DB::table('goods')->where('goods_id',$goods_id)->update($good_data);
        $history = DB::table('history')->where('goods_id',$goods_id)->first();
        $time = time();
        if($history == NULL){
            $history_data = [
                'goods_id'=>$goods_id,
                'create_time'=>$time,
                'goods_name'=>$goods_name
            ];
//            print_r($history_data);die;
            DB::table('history')->insert($history_data);
        }else{
            $history_data = [
                'create_time'=>$time
            ];
            DB::table('history')->where('goods_id',$goods_id)->update($history_data);
        }
        return view('index.goodsDetail',['arr'=>$arr]);
    }
    /**
     * @param $goods_id
     * 取缓存  点击量
     */
    public function lis(){
            $keylist = "pk:goods:view";
            $redis = new \Redis();
            $redis -> connect('127.0.0.1',6379);
            $arr = Redis::zRevRange($keylist,0,10000,true);
            $data = [];
            foreach ($arr as $k=>$v){
                $data[] = $k;
            }
//            print_r($data);die;
            $arr = DB::table('goods')->whereIn('goods_id',$data)->orderBy('look_num','desc')->get()->toArray();
//            var_dump($arr);die;
        return view('index.lis',['arr'=>$arr]);
    }
    /**
     * @param $goods_id
     * 浏览历史
     */
    public function history(){
        $arr = DB::table('history')->orderBy('create_time','desc')->get()->toArray();
        return view('index.history',['arr'=>$arr]);
    }
    /*
     * 添加购物车
     * */
    public function add($goods_id){
        //是否购买商品
        if(empty($goods_id)){
            header('Refresh:3;url=/cart');
            die("请选择购买的商品");
        }

        //商品是否有效
        $goods = GoodsModel::where(['goods_id'=>$goods_id])->first();
        if ($goods){

            //商品是否上架
            if ($goods->goods_up > 1 ){
                header("Refresh:3;url=index");
                echo "该商品已下架，请重新选择商品";
                die;
            }

            //商品库存是否充足
            if ($goods->goods_num == 0 ){
                header("Refresh:3;url=index");
                echo "该商品库存不足，请重新选择商品";
                die;
            }

            //进行添加购物车
            $cart_info = [
                'goods_id'        => $goods['goods_id'],
                'goods_name'      => $goods['goods_name'],
                'goods_selfprice' => $goods['goods_selfprice'],
                'user_id'         => Auth::id(),
                'create_time'     => time(),
                'session_id'      => Session::getId(),
                'buy_number'      => 1
            ];
            //执行入库
            $cart_id = CartModel::insertGetId($cart_info);
            if ($cart_id){
                header('Refresh:3;url=/cart');
                die("添加购物车成功，自动跳转至购物车");
            }else{
                header('Refresh:3;url=/index');
                die("添加购物车失败");
            }

        }else{
            echo '该商品不存在';
        }
    }
}

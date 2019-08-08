<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo json_encode(array('status'=>1,'msg'=>'login success','data'=>array('uid'=>9527,'username'=>'ebuyer')));
    }

    public function json(){
        $arr = array('status'=>1,'mes'=>'ok!');
        echo json_encode($arr);
    }
}
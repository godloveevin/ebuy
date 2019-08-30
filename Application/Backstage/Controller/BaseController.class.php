<?php
/**
 * 后台控制器基类定义文件
 * @author  godloveevin
 * @D/T 2019/08/15
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Controller;

use Think\Controller;

/**
 * Class BaseController
 * 定义后台的控制器基类
 * @package Backstage\Controller
 */
class BaseController extends Controller {

    // 构造方法
    public function __construct() {
        parent::__construct();

        // 判断用户是否登录
        $adminInfo = session('adminInfo');
        if(!$adminInfo){
            $this->error('请先登录!',U('Login/login'));
        }
    }

    /**
     * 获取数据表的所有字段信息，以‘a','b','c'.的格式
     * @param array $array 为索引数组
     * @return string
     */
    protected function getFieldsToSting($array=array()){
        $res = '';
        foreach($array as $k=>$v){
            $res.= "'".$v."',";
        }
        return $res;
    }

    // 添加空操作方法，提升用户体验
    protected function _empty(){
        echo '该系统的模块('.MODULE_NAME.')下的控制器('.CONTROLLER_NAME.')中没有实现您访问的操作('.ACTION_NAME.')，请检查系统代码！';
    }
}

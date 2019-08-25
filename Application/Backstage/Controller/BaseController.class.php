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
}

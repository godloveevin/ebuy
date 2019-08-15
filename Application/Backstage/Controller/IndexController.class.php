<?php
/**
 * 后台首页控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/08
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

use Think\Controller;

class IndexController extends Controller {

    // 显示后台首页
    public function index(){
        $this->display();
    }
    // 显示后台首页top
    public function top(){
        $this->display();
    }
    // 显示后台首页menu
    public function menu(){
        $this->display();
    }
    // 显示后台首页main
    public function main(){
        $this->display();
    }
    // 关于我们
    public function aboutUs(){}
}
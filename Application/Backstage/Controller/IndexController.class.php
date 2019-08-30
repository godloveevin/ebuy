<?php
/**
 * 后台首页控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/08
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

/**
 * Class IndexController
 * 定义后台首页控制器类
 * @package Backstage\Controller
 */
class IndexController extends BaseController {

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
        // 赋值菜单数据给视图模板
        $this->assign('menus',$this->admin['menus']);
        $this->display();
    }
    // 显示后台首页main
    public function main(){
        $this->display();
    }

    //设置导航栏
    public function setting(){}
    // 关于我们
    public function aboutUs(){}

    // 留言板
    public function msgList(){}

    // 帮助
    public function help(){}

    // 开店向导
    public function openShopGuide(){}

    // 服务市场
    public function serverMarket(){}

    // 清楚缓存
    public function clear_cache(){}
}
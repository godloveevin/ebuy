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
    public function index(){
        echo 'Backstage center.<br>';
    }
}
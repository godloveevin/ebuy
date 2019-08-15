<?php
/**
 * 后台商品分类控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/16
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Controller;
use Backstage\Model\CategoryModel;

/**
 * Class CategoryController
 * 定义分类控制器类
 * @package Backstage\Controller
 */
class CategoryController extends BaseController{

    // 分类列表
    public function index(){
        $catInfo = D("Category")->getTreeCatInfo();
        $this->assign('cat_Info',$catInfo);
        $this->display();
    }

    // 新增分类
    public function add() {
        if(IS_GET){
            $this->display();
        }else{
            // 数据入库

        }
    }

}
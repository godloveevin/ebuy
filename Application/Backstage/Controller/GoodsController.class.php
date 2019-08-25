<?php
/**
 * 后台商品控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/24
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

/**
 * Class GoodsController
 * 定义后台商品控制器类
 * @package Backstage\Controller
 */
class GoodsController extends BaseController {
    // 商品列表首页
    public function index(){
        $this->display();
    }

    // 添加商品
    public function add(){
        if(IS_GET){
            // echo $this->getFieldsToSting(D('Goods')->getDbFields());die;//获取表字段

            // 获取分类信息并赋值给模板
            $catInfos = D('Category')->getTreeCatInfo("cat_id,cat_name,parent_id");
            // dump($catInfos);die;
            $this->assign('catInfos',$catInfos);
            $this->display();
        }else{
            // 数据入库
            $model = D('Goods');
            // 创建数据
            $info = $model->create();
            if(!$info){
                $this->error($model->getError());
            }
            $insertId = $model->add($info);
            if(!$insertId){
                // 入库失败
                $this->error($model->getError());
            }else{
                // 写入成功
                $this->success('录入成功');
            }
        }
    }

    // 测试方法
    function test(){

    }

    // 商品类型
    public function type(){}

    // 商品品牌
    public function brand(){}

    // 商品回收站
    public function trash(){}

    // 商品复制
    public function copy(){}

}
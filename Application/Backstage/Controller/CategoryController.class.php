<?php
/**
 * 后台商品分类控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/16
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Controller;

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
            // 获取分类信息并赋值给模板
            $catInfos = D('Category')->getTreeCatInfo("cat_id,cat_name,parent_id");
            $this->assign('catInfos',$catInfos);
            $this->display();
        }else{
            // 数据入库
            $categoryModel = D('Category');
            // 创建数据
            $catInfos = $categoryModel->create();
            if(!$catInfos){
                $this->error($categoryModel->getError());
            }
            $insertId = $categoryModel->add($catInfos);
            if(!$insertId){
                // 入库失败
                $this->error('录入失败');
            }else{
                // 写入成功
                $this->success('录入成功');
            }
        }
    }

    // 编辑分类
    public function edit(){
        if(IS_GET){
            // 获取本分类信息
            $cat_id = $_GET['cat_id'];
            $catInfo = D('Category')->getCatInfoById($cat_id);
            // 获取全部分类
            $catInfos = D('Category')->getTreeCatInfo("cat_id,cat_name,parent_id");
            $this->assign(array('catInfo'=>$catInfo,'catInfos'=>$catInfos));
            $this->display();
        }else{
            // 数据入库
            $categoryModel = D('Category');
            // 创建数据
            $catInfo = $categoryModel->create();
            if(!$catInfo){
                $this->error($categoryModel->getError());
            }
            $res = $categoryModel->save();
            if($res === false){
                // 入库失败
                $this->error($categoryModel->getError());
            }else{
                // 写入成功
                $this->success('编辑成功',U('index'));
            }
        }
    }

    // ajax删除删除分类信息
    public function dels(){
        $cat_id = intval(I('get.cat_id'));
        if(!$cat_id){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败'));
        }
        // 删除分类逻辑
        // 如果有子分类，则禁止删除
        $model = D('Category');
        if($model->getChildCat($cat_id))
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败，有子分类禁止删除'));

        // 如果该分类下有商品的话，禁止删除
        if(D('Goods')->getGoodsInfoByCatId($cat_id))
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败，分类下有商品禁止删除'));

        // 该分类与子分类存在扩展分类记录的，禁止删除
        // 组装分类id
        $cat_ids[] = $cat_id; // 本分类id
        // 组装本分类下的子分类
        $sub_cat_ids = $model->getTreeCatInfoNoCached("cat_id,cat_name,parent_id",$cat_id);
        foreach ($sub_cat_ids as $k=>$v) {
            $cat_ids[] = $v['cat_id'];
        }
        // 根据扩展分类获取符合条件的商品id集
        $good_cate_infos = M('goods_category')->group('good_id')
            ->where(array('cat_id'=>array('in',$cat_ids)))->select();
        if($good_cate_infos)
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败，分类与子分类存在扩展分类记录的，禁止删除'));

        // 执行删除分类操作
        if(!$model->dels($cat_id))
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败，系统错误'));
        $this->ajaxReturn(array('status'=>1,'msg'=>'ok!'));
    }

}
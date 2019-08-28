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
        // 组装搜索条件
        $where = array();
        if(IS_POST){
            // 处理分类搜索条件
            $cat_id = I('post.cat_id');
            if(!empty($cat_id)){
                // 组装分类id
                $cat_ids[] = $cat_id; // 本分类
                // 组装本分类下的子分类
                $sub_cat_ids = D('Category')->getTreeCatInfoNoCached("cat_id,cat_name,parent_id",$cat_id);
                foreach ($sub_cat_ids as $k=>$v) {
                    $cat_ids[] = $v['cat_id'];
                }
                $where['cat_id'] = array('in',$cat_ids);
            }

            // 处理推荐类型搜索条件
            $intro_type = I('post.intro_type');
            if(!empty($intro_type)) $where[$intro_type] = 1;

            // 处理上下架搜索条件
            $is_sale = I('post.is_sale');
            if(isset($is_sale) && ($is_sale!=null)) $where['is_sale'] = $is_sale;

            // 处理关键字搜索条件
            $keywords = I('post.keyword');
            if(!empty($keywords)){
                // 单个词的搜索
                $where['good_name'] = array('like','%'.$keywords.'%');
            }
        }

        // 获取分类信息并赋值给模板
        $catInfos = D('Category')->getTreeCatInfo("cat_id,cat_name,parent_id");
        $goodInfos = D('Goods')->getGoodsInfoList($where);
        $this->assign(array(
            'catInfos' => $catInfos,
            'goodInfos' => $goodInfos['data'],
            'pageInfo'=>$goodInfos['pageInfo'],
        ));
        $this->display();
    }

    // 添加商品
    public function add(){
        if(IS_GET){
            // 获取分类信息并赋值给模板
            $catInfos = D('Category')->getTreeCatInfo("cat_id,cat_name,parent_id");
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
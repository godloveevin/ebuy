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

                // 根据扩展分类获取符合条件的商品id集
                $good_cate_infos = M('goods_category')->group('good_id')
                    ->where(array('cat_id'=>array('in',$cat_ids)))->select();
                if($good_cate_infos){
                    foreach ($good_cate_infos as $k=>$v) $good_cate_ids[] = $v['good_id'];
                    $condition['good_id'] = array('in',$good_cate_ids);
                    $condition['cat_id'] = array('in',$cat_ids);
                    $condition['_logic'] = 'or';
                    $where['_complex'] = $condition;
                }else{
                    $where['cat_id'] = array('in',$cat_ids);
                }
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

    // 商品回收站，ajax删除
    public function trash(){
        $good_id = I('get.good_id');
        if(!$good_id){
            $this->ajaxReturn(array('status'=>0,'msg'=>'回收失败'));
        }
        // 回收商品逻辑，伪删除
        $model = D('Goods');
        if(!$model->trashGoodById($good_id))
            $this->ajaxReturn(array('status'=>0,'msg'=>'回收失败，系统错误'));
        $this->ajaxReturn(array('status'=>1,'msg'=>'ok!'));
    }

    // 商品编辑
    public function edit(){
        if(IS_GET){
            // 处理分类信息
            $catInfos = D('Category')->getTreeCatInfo("cat_id,cat_name,parent_id");

            // 处理商品的基本信息
            $good_id = intval(I('get.good_id'));
            if(!$good_id) $this->error('编辑有误');
            $goodInfo = D('Goods')->getGoodInfoById($good_id);
            if(!$goodInfo) $this->error('编辑有误');
            // 处理日期时间格式
            $goodInfo['promote_start_date'] = $goodInfo['promote_start_date']?
                date('Y-m-d H:i:s',$goodInfo['promote_start_date']):0;
            $goodInfo['promote_end_date'] = $goodInfo['promote_end_date']?
                date('Y-m-d H:i:s',$goodInfo['promote_end_date']):0;
            // 处理扩展分类
            $goodExtCateIds = M('Goods_category')->where('good_id='.$good_id)->select();
            if($goodExtCateIds) $goodInfo['goodExtCateIds'] = $goodExtCateIds;

            // 集体赋值给模板
            $this->assign(array(
                'catInfos'=>$catInfos,
                'goodInfo'=>$goodInfo,
            ));
            $this->display();
        }else {
            // 编辑信息入库
            $model = D('Goods');
            // 创建数据
            $info = $model->create();
            if(!$info) $this->error($model->getError());
            // 更新入库
            $insertId = $model->update($info);
            if(!$insertId){
                // 入库失败
                $this->error($model->getError());
            }else{
                // 写入成功
                $this->success('编辑录入成功',U('index'));
            }
        }
    }

}
<?php
/**
 * 后台商品模型类文件
 * @author  godloveevin
 * @D/T 2019/08/24
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class GoodsModel
 * 定义商品模型
 * @package Backstage\Model
 */
class GoodsModel extends BaseModel {
    // 表名
    protected $tableName = 'goods';
    // 表前缀
    protected $tablePrefix = 'eb_';
    // 主键
    protected $pk = 'good_id';
    // 自定义字段
    protected $fields = array(
        'good_id','good_sn','good_name','good_desc','cat_id','market_price',
        'sale_price','promote_price','promote_start_date','promote_end_date','good_img',
        'good_thumb','is_hot','is_new','is_rec','is_del','is_sale','addtime','sort_order',
        );
    // 自动验证
    protected $_validate = array(

    );

    // 插入数据前的回调方法，钩子方法
    protected function _before_insert(&$data,$options) {
        // 格式化录入数据

        // 录入时间处理
        $data['addtime'] = time();

        // 商品货号处理
        if(!$data['good_sn']){
            // 没填货号
            $data['good_sn'] = 'EBUY'.uniqid();
        }else{
            // 填写了货号
            if($this->where("good_sn='".$data['good_sn']."'")->find()){
                $this->error = '货号重复！';
                return false;
            }
        }

        // 促销时间格式处理
        $data['promote_start_date'] = strtotime($data['promote_start_date']);
        $data['promote_end_date'] = strtotime($data['promote_end_date']);

        // 处理图片上传问题
        $res = $this->uploadImg();
        if($res){
            $data['good_img'] = $res['good_img'];
            $data['good_thumb'] = $res['good_thumb'];
        }
    }

    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
        // 完成扩展分类的数据入库
        $good_id = $data['good_id'];
        $ext_cat_ids = I('post.e_cat_id');
        $goodsCategoryModle =  D('goods_category');
        $res = $goodsCategoryModle->insertExtCategorys($ext_cat_ids,$good_id);
        if($res === false){
            $this->error = $goodsCategoryModle->getError();
        }
    }

    // 根据分类id获取商品信息
    public function getGoodsInfoByCatId($cat_id=''){
        return $this->where(array('cat_id'=>$cat_id,'is_del'=>0))->find();
    }

    // 根据刷选条件获取商品列表数据
    public function getGoodsInfoList($condition=array(),$is_trashed=false){
        $where = $condition;
        if($is_trashed){
            $where['is_del'] = 1;
        }else{
            // 默认获取没有被删除的商品
            $where['is_del'] = 0;
        }
        // 处理分页
        $pageData = $this->_getPageData($where,$is_trashed);
        // 获取数据
        $data = $this->where($where)->page($pageData['curPage'],$pageData['pageSize'])->select();
        return array('pageInfo'=>$pageData,'data'=>$data);
    }

    // 获取总记录数
    private function _getTotal($where='',$is_trashed=false){
        if($is_trashed){
            $where['is_del'] = 1;
        }else{
            $where['is_del'] = 0;
        }

        $res = $this->where($where)->count();
        return $res;
    }

    // 获取分页数据
    private function _getPageData($where='',$is_trashed=false){
        // 处理分页条件
        $cur_page = I('get.p',1);//当前页，默认取
        $total = $this->_getTotal($where,$is_trashed);// 总记录数
        $page_size = C('PAGE_SIZE');//每页显示的条目数
        $total_pages = ceil($total/$page_size);//总页数
        // 组装页码url
        $firstPageUrl = U(ACTION_NAME,'p=1'); // 首页
        $lastPageUrl = U(ACTION_NAME,'p='.$total_pages); // 尾页
        if(($cur_page > 1) && ($cur_page <= $total_pages)) {
            $prevPageUrl = U(ACTION_NAME,'p='.($cur_page-1));
        }else{
            $prevPageUrl = 0;
        }//上一页
        if(($cur_page >= 1) && ($cur_page < $total_pages)){
            $nextPageUrl = U(ACTION_NAME,'p='.($cur_page+1));
        }else{
            $nextPageUrl = 0;
        }//下一页

        return array(
            'curPage' => $cur_page,
            'total'=> $total,
            'pageSize'=>$page_size,
            'totalPages' => $total_pages,
            'firstPageUrl'=>$firstPageUrl,
            'lastPageUrl'=>$lastPageUrl,
            'prevPageUrl'=>$prevPageUrl,
            'nextPageUrl'=>$nextPageUrl,
        );
    }

    // 回收商品以及还原商品
    public function trashGoodById($good_id,$is_del=1){
        return $this->where("good_id=$good_id")->setField('is_del',$is_del);
    }

    /**
     * 根据商品id获取商品信息
     * @param $good_id 商品id
     * @return mixed
     */
    public function getGoodInfoById($good_id){
        return $this->where('good_id='.$good_id)->find();
    }

    /**
     * 根据商品id修改商品信息
     * @param array $data 用户待修改的数据
     * @return mixed
     */
    public function update($data=array()){
        $good_id = $data['good_id'];
        // 处理货号问题
        $good_sn = $data['good_sn'];
        if($good_sn){
            $res = $this->where("good_sn='$good_sn' AND good_id != $good_id")->find();
            if($res){
                $this->error = '货号重复';
                return false;
            }
        }else{
            $data['good_sn'] = 'EBUY'.uniqid();
        }

        // 处理扩展分类问题
        $ext_cat_ids = I('post.e_cat_id');
        $goodsCategoryModle =  D('goods_category');
        $res = $goodsCategoryModle->insertExtCategorys($ext_cat_ids,$good_id);
        if($res === false){
            $this->error = $goodsCategoryModle->getError();
        }

        // 处理图片上传问题
        $res = $this->uploadImg();
        if($res){
            $data['good_img'] = $res['good_img'];
            $data['good_thumb'] = $res['good_thumb'];
        }
        return $this->save($data);
    }

    public function uploadImg(){
        // 实现图片上传
        $fileImg = $_FILES['good_img'];
        if($fileImg['error'] === 4){
            // 没上传图片
            $this->error = '请你先上传商品主图';
            return false;
        }else if($fileImg['error'] === 0){
            $upload = new \Think\Upload();
            $info = $upload->uploadOne($fileImg);
            if (!$info) {
                $this->error = $upload->getError();
            }
            $good_img= 'Uploads/' . $info['savepath'] . $info['savename'];

            // 制作缩略图
            $image = new \Think\Image();
            // 打开图片
            $image->open($good_img);
            // 保存缩略图
            $thumb_img = 'Uploads/' . $info['savepath'] . 'thumb_' . $info['savename'];
            $image->thumb(400, 400)->save($thumb_img);
            return array('good_img'=>$good_img,'good_thumb'=>$thumb_img);
        }
    }

    /**
     * 彻底删除商品
     * @param $good_id
     * @return array
     */
    public function drop($good_id){
        $goodInfo = $this->where('good_id='.$good_id)->find();
        if(!$goodInfo) return array('status'=>0,'msg'=>'系统异常');
        // 处理图片删除
        unlink($goodInfo['good_img']);
        unlink($goodInfo['good_thumb']);
        // 处理扩展分类删除
        $res = D('GoodsCategory')->where('good_id='.$good_id)->delete();
        if($res === false){
            return array('status'=>0,'msg'=>'删除扩展分类失败');
        }
        // 商品自身信息删除
        $res = $this->where('good_id='.$good_id)->delete();
        if($res === false){
            return array('status'=>0,'msg'=>'删除商品失败');
        }
        return array('status'=>1,'msg'=>'ok');
    }

}
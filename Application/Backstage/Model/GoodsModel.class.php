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
        // 格式化带出入的数据

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

        // 实现图片上传
        $upload = new \Think\Upload();
        $info = $upload->uploadOne($_FILES['good_img']);
        if(!$info){
            $this->error = $upload->getError();
        }
        $data['good_img'] = 'Uploads/'.$info['savepath'].$info['savename'];

        // 制作缩略图
        $image = new \Think\Image();
        // 打开图片
        $image->open($data['good_img']);
        // 保存缩略图
        $data['good_thumb'] = 'Uploads/'.$info['savepath'].'thumb_'.$info['savename'];
        $image->thumb(400,400)->save($data['good_thumb']);

    }

    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
        // 完成扩展分类的数据入库
        $good_id = $data['good_id'];
        $ext_cat_ids = I('post.e_cat_id');
        // 去重操作
        $ext_cat_ids = array_unique($ext_cat_ids);
        foreach ($ext_cat_ids as $k=>$v){
            $dataList[] = array(
                'good_id' => $good_id,
                'cat_id' => $v,
            );
        }
        // 批量插入
        $res = M('goods_category')->addAll($dataList);
        if($res === false){
            $this->error = '扩展分类入库失败';
            return false;
        }
    }

    // 根据分类id获取商品信息
    public function getGoodsInfoByCatId($cat_id=''){
        return $this->where(array('cat_id'=>$cat_id,'is_del'=>0))->find();
    }

    // 根据刷选条件获取商品列表数据
    public function getGoodsInfoList($condition=array()){
        $where = $condition;
        // 默认获取没有被删除的商品
        $where['is_del'] = 0;

        // 处理分页
        $pageData = $this->_getPageData($where);

        // 获取数据
        $data = $this->where($where)->page($pageData['curPage'],$pageData['pageSize'])->select();

        // echo $this->getLastSql();
        return array('pageInfo'=>$pageData,'data'=>$data);
    }

    // 获取总记录数
    public function getTotal($where=''){
        $where['is_del'] = 0;
        $res = $this->where($where)->count();
        return $res;
    }

    // 获取分页数据
    private function _getPageData($where=''){
        // 处理分页条件
        $cur_page = I('get.p',1);//当前页，默认取
        $total = $this->getTotal($where);// 总记录数
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

}
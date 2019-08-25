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

    }

}
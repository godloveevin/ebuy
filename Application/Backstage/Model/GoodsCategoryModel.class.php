<?php
/**
 * 后台商品扩展分类模型类文件
 * @author  godloveevin
 * @D/T 2019/08/28
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class GoodsCategoryModel
 * 定义商品模型
 * @package Backstage\Model
 */
class GoodsCategoryModel extends BaseModel {
    // 表名
    protected $tableName = 'goods_category';
    // 表前缀
    protected $tablePrefix = 'eb_';
    // 主键
    protected $pk = 'e_cat_id';
    // 自定义字段
    protected $fields = array(
        'e_cat_id','good_id','cat_id',
    );
    // 自动验证
    protected $_validate = array(

    );

    public function insertExtCategorys($ext_cat_ids,$good_id){
        // 先删除原先的扩展分类数据
        $res = $this->where('good_id='.$good_id)->delete();
        if($res === false){
            $this->error = '删除原始的扩展有误';
            return false;
        }
        // 去重操作
        $ext_cat_ids = array_unique($ext_cat_ids);
        foreach ($ext_cat_ids as $k=>$v){
            $dataList[] = array(
                'good_id' => $good_id,
                'cat_id' => $v,
            );
        }
        // 批量插入
        $res = $this->addAll($dataList);
        if($res === false){
            $this->error = '扩展分类入库失败';
            return false;
        }
    }

}
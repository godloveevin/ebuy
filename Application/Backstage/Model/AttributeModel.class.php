<?php
/**
 * 后台商品属性模型类文件
 * @author  godloveevin
 * @D/T 2019/09/08
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class AttributeModel
 * 定义商品属性模型类
 * @package Backstage\Model
 */
class AttributeModel extends BaseModel {
    // 表名
    protected $tableName = 'attribute';
    // 表前缀
    protected $tablePrefix = 'eb_';
    // 主键
    protected $pk = 'attr_id';
    // 自定义字段
    protected $fields = array(
        'attr_id','attr_name','attr_describe','type_id','attr_type',
        'attr_input_type','attr_values','addtime','updatetime','is_del',
    );
    // 自动验证
    protected $_validate = array(
        array('attr_name','require','属性名称必须填写',),
    );

    /**
     * @param $data
     * @param $options
     * @return bool|void
     */
    public function _before_insert(&$data, $options)
    {
        // 处理录入时间
        $data['addtime'] = time();
        // 处理更新时间
        $data['updatetime'] = time();

        // 处理属性名重复问题
        $res = $this->where("attr_name='".$data['attr_name']."' AND is_del=0")->find();
        if($res){
            $this->error = '属性名不能重复！';
            return false;
        }
    }
}
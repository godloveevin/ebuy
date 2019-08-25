<?php
/**
 * 后台分类模型类文件
 * @author  godloveevin
 * @D/T 2019/08/16
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class CategoryModel
 * 定义商品分类模型类
 * @package Backstage\Model
 */
class CategoryModel extends BaseModel {
    // 自定义主键
    protected $pk = 'cat_id';

    // 自定义字段
    protected $fields = array(
        'cat_id', 'parent_id', 'cat_name', 'keywords', 'cat_desc',
        'sort_order', 'template_file', 'measure_unit', 'show_in_nav',
        'is_show', 'filter_attr', 'is_rec',
    );
    // 自动验证
    protected $_validate = array(
        array('cat_name','require','分类名称必须填写',),
        // array('cat_name','','分类名称不能重复',0,'unique',1),
    );

    // 获取商品分类数据
    public function getTreeCatInfo($fields='*'){
        $data = $this->field($fields)->where('is_show=1')->select();
        if(!$data){
            $this->error = "暂无商品分类数据";
        }
        $res = $this->getTreeData($data,$parent_id=0,$level=1,$isCached=true);
        return $res;
    }

    // 私有的格式化商品分类数据的方法
    private function getTreeData($data,$parent_id=0,$level=1,$isCached=true){
        static $res = array();
        if(!$isCached){
            $res = array();
        }
        foreach($data as $k=>$v){
            if($v['parent_id'] == $parent_id){
                $v['level'] = $level;
                $v['step'] = ($level-1) * 2;
                $v['url'] = U('detail','cat_id='.$v['cat_id']);
                $res[] = $v;
                $this->getTreeData($data,$v['cat_id'],$v['level']+1);
            }
        }
        return $res;
    }

    // 根据id获取分类信息
    public function getCatInfoById($cat_id){
        return $this->where('cat_id='.$cat_id)->find();
    }

    // 根据分类id获取子分类信息
    public function getChildCat($cat_id,$fields='cat_id'){
        return $this->field($fields)->where("parent_id=$cat_id")->select();
    }

    // 删除分类，伪删除，将is_show设置为0，不显示
    public function dels($cat_id){
        return $this->where("cat_id=$cat_id")->setField('is_show',0);
    }

    // 根据id编辑数据
    public function update(){

    }

}
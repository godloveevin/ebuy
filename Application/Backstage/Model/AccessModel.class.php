<?php
/**
 * 后台权限模型类文件
 * @author  godloveevin
 * @D/T 2019/08/15
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class AccessModel
 * 定义后台权限模型类
 * @package Backstage\Model
 */
class AccessModel extends BaseModel {
    // 表名
    protected $tableName = 'access';
    // 表前缀
    protected $tablePrefix = 'eb_';
    // 主键
    protected $pk = 'access_id';
    // 自定义字段
    protected $fields = array(
        'access_id','parent_id','access_name','access_string','access_mode',
        'access_controller','access_action','addtime','is_show','is_del',
    );
    // 自动验证
    protected $_validate = array(
        array('access_name','require','权限名称必填'),
        array('access_mode','require','模型名称必填'),
        array('access_controller','require','控制器名称必填'),
        array('access_action','require','方法名称必填'),

    );

    // 获取排序好的权限集(二维数组)
    public function getTreeAccessInfo(){
        $res = $this->select();
        $res = $this->getTreeInfo($res,$pid=0,$level=1);
        $this->getTreeMultiInfo($res);
        return $res;
    }

    // 定义处理权限集的私有方法
    private function getTreeInfo($data,$parent_id=0,$level=1,$is_cached=true){
        static $res = array();
        if(!$is_cached){
            $res = array();
        }
        foreach($data as $k=>$v){
            if($v['parent_id'] == $parent_id) {
                $v['level'] = $level;
                $res[] = $v;
                $this->getTreeInfo($data,$v['access_id'],$v['level']+1);
            }
        }
        return $res;
    }

    // 将一维数组装换子权限为父权限的一个元素
    private function getTreeMultiInfo(&$data){
       foreach($data as $k=>$v){
           static $tmp_key = 0;
           if($v['parent_id'] == 0){
                $tmp_key = $k;//保存父类id的key
           } else {
               $data[$tmp_key]['subAccess'][] = $v;
               unset($data[$k]);
           }
       }
       $data = array_values($data);
    }

    /**
     * 获取顶级权限
     * @return mixed
     */
    public function getTopAccessList(){
        return $this->where('parent_id=0')->select();
    }

    public function _before_insert(&$data, $options){
        parent::_before_insert($data, $options);
        // dump($data);die;

        // 处理录入时间问题
        $data['addtime'] = time();
        // 处理模型名称
        if(intval($data['access_mode']) === 1) $data['access_mode'] = 'Backstage';  // 后台模块名
        if(intval($data['access_mode']) === 2) $data['access_mode'] = 'Home';       // 前台模块名
        if(intval($data['access_mode']) === 3) $data['access_mode'] = 'Api';        // Api模块名
        // 处理权限字符串问题
        $data['access_string'] = $data['access_mode'].'/'.$data['access_controller'].'/'.$data['access_action'];
        // 处理父权限id
        $data['parent_id'] = intval($data['parent_id']);

        // 排除重复的权限
        if($this->where("access_name='".$data['access_name']."'")->find()){
            $this->error = '权限名称不能重复！';
            return false;
        }
    }

}
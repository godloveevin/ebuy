<?php
/**
 * 后台权限模型类文件
 * @author  godloveevin
 * @D/T 2019/08/15
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class AcessModel
 * 定义后台权限模型类
 * @package Backstage\Model
 */
class AccessModel extends BaseModel {

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

}
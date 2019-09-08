<?php
/**
 * 后台类型模型类文件
 * @author  godloveevin
 * @D/T 2019/09/08
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class TypeModel
 * 定义角色模型
 * @package Backstage\Model
 */
class TypeModel extends BaseModel {
    // 表名
    protected $tableName = 'type';
    // 表前缀
    protected $tablePrefix = 'eb_';
    // 主键
    protected $pk = 'type_id';
    // 自定义字段
    protected $fields = array(
        'type_id','type_name','type_describe','addtime','updatetime','is_del',
    );
    // 自动验证
    protected $_validate = array(
        array('type_name','require','类型名必须填写！'),
    );

    /**
     * 获取未被删除的类型列表
     * @param bool $is_del
     * @return mixed
     */
    public function getInfoList($is_del=false){
        if($is_del){
            $where['is_del'] = 1;
        }else{
            $where['is_del'] = 0;
        }
        // 分页处理
        $pageData = $this->getPageData($where);
        // 获取数据
        $data = $this->where($where)->page($pageData['curPage'],$pageData['pageSize'])->select();
        return array('pageInfo'=>$pageData,'data'=>$data);
    }

    /**
     * 删除角色，伪删除
     * @param int $type_id
     * @return array $result
     */
    public function drop($type_id){
        $result = array('status'=>1,'msg'=>'ok');
        $roleInfo = $this->where('type_id='.$type_id)->find();
        if(!$roleInfo) {
            $result['status'] = 0;
            $result['msg'] = '系统异常';
            return $result;
        }
        $res = $this->where('type_id=' . $type_id)->setField('is_del', 1);
        if ($res === false) {
            $result['status'] = 0;
            $result['msg'] = '删除角色失败';
            return $result;
        }
        return $result;
    }

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

        // 处理类型名重复问题
        $res = $this->where("type_name='".$data['type_name']."' AND is_del=0")->find();
        if($res){
            $this->error = '类型名不能重复！';
            return false;
        }
    }

    /**
     * 更新记录信息
     * @param array $data
     * @return bool
     */
    public function update($data=array()){
        // 处理录入时间
        $data['updatetime'] = time();

        // 类型名称不能重复
        if($this->where("is_del=0 AND type_id!=".$data['type_id']." AND type_name='".$data['type_name']."'")->find()){
            $this->error = '类型名称不能重复！';
            return false;
        }
        return $this->save($data);
    }

    /**
     * 根据type_id获取一条类型记录
     * @param $type_id
     * @return mixed
     */
    public function getInfoById($type_id){
        return $this->where('type_id='.$type_id)->find();
    }

}
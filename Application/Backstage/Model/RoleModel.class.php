<?php
/**
 * 后台角色模型类文件
 * @author  godloveevin
 * @D/T 2019/08/24
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class RoleModel
 * 定义角色模型
 * @package Backstage\Model
 */
class RoleModel extends BaseModel {
    // 表名
    protected $tableName = 'role';
    // 表前缀
    protected $tablePrefix = 'eb_';
    // 主键
    protected $pk = 'role_id';
    // 自定义字段
    protected $fields = array(
        'role_id','role_name','action_list','access_ids','role_describe','addtime','updatetime','is_del',
    );
    // 自动验证
    protected $_validate = array(
        array('role_name','require','角色名必须填写！'),
    );

    /**
     * 获取未被删除的角色列表
     * @param bool $is_del
     * @return mixed
     */
    public function getRoleInfoList($is_del=false){
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
     * @param $role_id
     * @return array
     */
    public function drop($role_id){
        $result = array('status'=>1,'msg'=>'ok');
        $roleInfo = $this->where('role_id='.$role_id)->find();
        if(!$roleInfo) {
            $result['status'] = 0;
            $result['msg'] = '系统异常';
            return $result;
        }
        // 超级管理员禁止删除
        if(($roleInfo['role_name'] === '超级管理员') || $role_id <= 1){
            $result['status'] = 0;
            $result['msg'] = '超级管理员禁止删除';
            return $result;
        }
        // 角色下有用户禁止删除
        $res = D('Admin')->where('role_id='.$role_id.' AND is_del=0')->find();
        if($res){
            $result['status'] = 0;
            $result['msg'] = '角色下存在有效用户，禁止删除';
            return $result;
        }
        $res = $this->where('role_id=' . $role_id)->setField('is_del', 1);
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
        $data['updatetime'] = time();

        // 处理权限id集
        if (is_array($data['access_ids']) && $data['access_ids']) {
            $data['access_ids'] = implode(',', $data['access_ids']);
        }

        // 角色名重复问题
        $res = $this->where("role_name='".$data['role_name']."' AND is_del=0")->find();
        if($res){
            $this->error = '角色名不能重复！';
            return false;
        }
    }

    public function update($data=array()){
        // 处理录入时间
        $data['updatetime'] = time();

        // 处理权限id集
        if(is_array($data['access_ids']) && $data['access_ids']){
            $data['access_ids'] = implode(',',$data['access_ids']);
        }else{
            $data['access_ids'] = '';
        }
        if(intval($data['role_id']) == 1){
            $this->error = '超级管理员角色禁止编辑！';
            return false;
        }
        // 角色名称不能重复
        if($this->where("is_del=0 AND role_id!=".$data['role_id']." AND role_name='".$data['role_name']."'")->find()){
            $this->error = '角色名称不能重复！';
            return false;
        }
        return $this->save($data);
    }

    /**
     * 根据role_id获取一条角色记录
     * @param $role_id
     * @return mixed
     */
    public function getRoleInfoById($role_id){
        return $this->where('role_id='.$role_id)->find();
    }

}
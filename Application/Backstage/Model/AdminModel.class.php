<?php
/**
 * 后台用户模型类文件
 * @author  godloveevin
 * @D/T 2019/08/24
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Model;

/**
 * Class AdminModel
 * 定义用户模型
 * @package Backstage\Model
 */
class AdminModel extends BaseModel {
    // 表名
    protected $tableName = 'admin';
    // 表前缀
    protected $tablePrefix = 'eb_';
    // 主键
    protected $pk = 'admin_id';
    // 自定义字段
    protected $fields = array(
        'admin_id','admin_name','email','password','eb_salt','last_login_time',
        'last_login_ip','role_id','addtime','updatetime','is_del','sort_order',
    );
    // 自动验证
    protected $_validate = array(
        array('admin_name','require','用户名必须填写'),
        array('password','require','密码必须填写'),
        array('role_id','require','角色必须选择'),
    );

    /**
     * TP钩子方法，插入数据之前，对入库数据进行处理
     * @param $data
     * @param $options
     * @return bool|void
     */
    public function _before_insert(&$data, $options){
        parent::_before_insert($data, $options);
        // 处理用户密码问题
        $data['eb_salt'] = uniqid('EBUY');
        $data['password'] = md5($data['password'].md5($data['eb_salt']));

        // 处理录入时间
        $data['addtime'] = time();

        // 管理员名称不可重复
        if($this->where("admin_name='".$data['admin_name']."' AND is_del=0")->find()){
            $this->error = '管理员名称不可重复！';
            return false;
        }
    }

    /**
     * 分页获取管理员数据
     * @param array $condition
     * @param bool $is_del
     * @return array
     */
    public function getAdminInfoList($condition=array(),$is_del=false){
        $where = $condition;
        if($is_del){
            $where.= ' AND a.is_del=1';
        }else{
            // 默认获取没有被删除的管理员
            $where.= ' AND a.is_del=0';
        }
        // 处理分页
        $pageData = $this->getPageData($where);
        // 获取数据
        $data = $this->alias('a')->field('a.*,r.role_name')->join("LEFT JOIN eb_role r ON r.role_id=a.role_id")->
                where($where)->page($pageData['curPage'],$pageData['pageSize'])->select();
        return array('pageInfo'=>$pageData,'data'=>$data);
    }

    /**
     * 删除管理员用户，伪删除
     * @param $id
     * @return array
     */
    public function drop($id){
        $result = array('status'=>1,'msg'=>'ok');
        $info = $this->where('admin_id='.$id)->find();
        if(!$info) {
            $result['status'] = 0;
            $result['msg'] = '系统异常';
            return $result;
        }
        // 删除
        if(($info['admin_id'] === 1)){
            $result['status'] = 0;
            $result['msg'] = '超级管理员禁止删除';
            return $result;
        }else {
            $res = $this->where('admin_id='.$id)->setField('is_del', 1);
            if ($res === false) {
                $result['status'] = 0;
                $result['msg'] = '删除角色失败';
                return $result;
            }
        }
        return $result;
    }

    /**
     * 更新管理员信息
     * @param array $data
     * @return bool
     */
    public function update($data=array()){
        // 超级管理员禁止编辑
        if(intval($data['admin_id']) == 1){
            $this->error = '超级管理员禁止编辑！';
            return false;
        }
        // 处理更新时间
        $data['updatetime'] = time();

        // 处理用户密码问题
        $info = $this->where('admin_id='.$data['admin_id'])->find();
        if(($data['password'] == $info['password'])||
            ($info['password'] == md5($data['password'].md5($info['eb_salt'])))){
            unset($data['password']);
        }else{
            $data['eb_salt'] = uniqid('EBUY');
            $data['password'] = md5($data['password'].md5($data['eb_salt']));
        }
        // 管理员的名字不能重复
        if($this->where("is_del=0 AND admin_id!=".$data['admin_id']." AND admin_name='".$data['admin_name']."'")->find()){
            $this->error = '管理员名不能重复！';
            return false;
        }
        return $this->save($data);
    }

}
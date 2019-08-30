<?php
/**
 * 后台用户控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/15
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

/**
 * Class AdminController
 * 定义后台用户控制器类
 * @package Backstage\Controller
 */
class AdminController extends BaseController {

    // 用户列表
    public function index(){
        // 处理搜索用户的条件
        $where = '1=1';
        if(IS_POST){
            // 处理角色搜索条件
            $role_id = intval(I('post.role_id'));
            if(!empty($role_id)){
                // $where['role_id'] = $role_id;
                $where.=" AND a.role_id=".$role_id;
            }
            // 处理管理员名称搜索条件
            $admin_name = I('post.keyword');
            if(!empty($admin_name)){
                // $where['admin_name'] = $admin_name;
                $where.=" AND a.admin_name='".$admin_name."'";
            }
        }
        // 获取角色列表
        $roleInfos = D('Role')->getRoleInfoList();
        // 获取管理员列表
        $adminInfos = D('Admin')->getAdminInfoList($where);
        if(empty($adminInfos['data'])){
            $adminInfos['data'] = 0;
        }else{
            // 处理时间格式问题
            foreach($adminInfos['data'] as $k=>$v){
                $adminInfos['data'][$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
                $adminInfos['data'][$k]['updatetime'] = date('Y-m-d H:i:s',$v['updatetime']);
            }
        }
        $this->assign(array(
            'roleInfos' => $roleInfos['data'],
            'adminInfos' => $adminInfos['data'],
            'pageInfo'=>$adminInfos['pageInfo'],
        ));
        $this->display();
    }

    /**
     * 添加管理员
     */
    public function add(){
        if(IS_GET){
            // 获取角色列表
            $roleInfos = D('Role')->getRoleInfoList();
            $this->assign(array(
                'roleInfos' => $roleInfos['data'],
            ));
            $this->display();
        }else{
            // 数据入库
            $model = D('Admin');
            // 创建数据
            $info = $model->create();
            if(!$info){
                $this->error($model->getError());
            }
            $insertId = $model->add($info);
            if(!$insertId){
                // 入库失败
                $this->error($model->getError());
            }else{
                // 写入成功
                $this->success('录入成功',U('index'));
            }
        }
    }

    // 修改用户信息
    public function edit(){
        if(IS_GET){
            $admin_id = intval(I('get.admin_id'));
            if(!$admin_id){
                $this->error('参数有误');
            }
            // 获取角色列表
            $roleInfos = D('Role')->getRoleInfoList();
            // 获取管理员信息
            $adminInfo = D('Admin')->where('admin_id='.$admin_id)->find();
            $this->assign(array(
                'roleInfos' => $roleInfos['data'],
                'adminInfo' => $adminInfo,
            ));
            $this->display();
        }else{
            $model = D('Admin');
            $data = $model->create();
            if(!$data){
                $this->error($model->getError());
            }
            $insertId = $model->update($data);
            if(!$insertId){
                // 入库失败
                $this->error($model->getError());
            }else {
                // 写入成功
                $this->success('编辑录入成功',U('index'));
            }
        }
    }

    // 删除用户信息
    public function drop(){
        $admin_id = intval(I('get.admin_id'));
        if(!$admin_id){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败'));
        }
        $res = D('Admin')->drop($admin_id);
        $this->ajaxReturn($res);
    }

}
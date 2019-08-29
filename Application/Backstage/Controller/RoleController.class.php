<?php
/**
 * 后台角色控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/24
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

/**
 * Class RoleController
 * 定义后台角色控制器类
 * @package Backstage\Controller
 */
class RoleController extends BaseController {

    /**
     * 角色列表页
     */
    public function index(){
        $roleInfos = D('Role')->getRoleInfoList();
        // 处理时间格式
        foreach($roleInfos['data'] as $k=>$v){
            $roleInfos['data'][$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $roleInfos['data'][$k]['updatetime'] = date('Y-m-d H:i:s',$v['updatetime']);
        }
        if(empty($roleInfos['data'])){
            $roleInfos['data'] = 0;
        }
        $this->assign(array(
            'roleInfos' => $roleInfos['data'],
            'pageInfo'=>$roleInfos['pageInfo'],
        ));
        $this->display();
    }

    /**
     * 新增角色
     */
    public function add(){
        if(IS_GET){
            // 获取权限列表
            $accessLists = D('Access')->getTreeAccessInfo();
            $this->assign('accessLists',$accessLists);
            $this->display();
        }else{
            $model = D('Role');
            $data = $model->create();
            if(!$data){
                $this->error($model->getError());
            }
            $insertId = $model->add($data);
            if(!$insertId){
                // 入库失败
                $this->error($model->getError());
            }else {
                // 写入成功
                $this->success('录入成功',U('index'));
            }
        }
    }

    /**
     * 删除角色
     */
    public function drop(){
        $role_id = intval(I('get.role_id'));
        if(!$role_id){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败'));
        }
        $res = D('Role')->drop($role_id);
        $this->ajaxReturn($res);
    }

    public function edit(){
        if(IS_GET){
            $role_id = intval(I('get.role_id'));
            // 获取权限列表
            $accessLists = D('Access')->getTreeAccessInfo();
            // 获取该角色的权限id集
            $roleInfo = D('Role')->getRoleInfoById($role_id);
            $access_ids = explode(',',$roleInfo['access_ids']);
            $this->assign(array(
                'accessLists'=>$accessLists,
                'roleInfo'=>$roleInfo,
                'access_ids'=>$access_ids,
                ));
            $this->display();
        }else{
            $model = D('Role');
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
}
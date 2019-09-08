<?php
/**
 * 后台类型控制器类文件
 * @author  godloveevin
 * @D/T 2019/09/08
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

/**
 * Class TypeController
 * 定义后台类型控制器类
 * @package Backstage\Controller
 */
class TypeController extends BaseController {

    /**
     * 类型列表页
     */
    public function index(){
        $infos = D('Type')->getInfoList();
        // 处理时间格式
        foreach($infos['data'] as $k=>$v){
            $infos['data'][$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $infos['data'][$k]['updatetime'] = date('Y-m-d H:i:s',$v['updatetime']);
        }
        if(empty($infos['data'])){
            $infos['data'] = 0;
        }
        $this->assign(array(
            'infos' => $infos['data'],
            'pageInfo'=>$infos['pageInfo'],
        ));
        $this->display();
    }

    /**
     * 新增类型
     */
    public function add(){
        if(IS_GET){
            $this->display();
        }else{
            $model = D('Type');
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
        $type_id = intval(I('get.type_id'));
        if(!$type_id){
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除失败'));
        }
        $res = D('Type')->drop($type_id);
        $this->ajaxReturn($res);
    }

    public function edit(){
        if(IS_GET){
            $type_id = intval(I('get.type_id'));
            // 获取该类型信息
            $info = D('Type')->getInfoById($type_id);
            $this->assign(array(
                'info'=>$info,
                ));
            $this->display();
        }else{
            $model = D('Type');
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
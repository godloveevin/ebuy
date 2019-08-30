<?php
/**
* 后台权限控制器类文件
* @author  godloveevin
* @D/T 2019/08/15
* @Email   godloveevin@yeah.net
*/

namespace Backstage\Controller;

/**
 * Class AccessController
 * 定义权限控制器类
 * @package Backstage\Controller
 */
class AccessController extends BaseController {

    // 权限显示
    public function index(){
        $accessInfos = D('Access')->getTreeAccessInfo();
        $this->assign('accessInfos',$accessInfos);
        $this->display();
    }

    // 新增权限
    public function add() {
        if(IS_GET){
            // 获取顶级权限
            $topAccessInfo = D('Access')->getTopAccessList();
            if($topAccessInfo === false){
                $this->error('系统异常');
            }

            $this->assign(array(
                'topAccessInfos' => $topAccessInfo,
            ));
            $this->display();
        }else{
            // 数据入库
            $model = D('Access');
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
}
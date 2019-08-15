<?php
/**
* 后台权限控制器类文件
* @author  godloveevin
* @D/T 2019/08/15
* @Email   godloveevin@yeah.net
*/

namespace Backstage\Controller;

use Backstage\Model\AccessModel;

/**
 * Class AcdessController
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
        $this->display();
    }
}
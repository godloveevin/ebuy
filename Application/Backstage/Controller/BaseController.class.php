<?php
/**
 * 后台控制器基类定义文件
 * @author  godloveevin
 * @D/T 2019/08/15
 * @Email   godloveevin@yeah.net
 */

namespace Backstage\Controller;

use Think\Controller;

/**
 * Class BaseController
 * 定义后台的控制器基类
 * @package Backstage\Controller
 */
class BaseController extends Controller {
    // 声明存放管理员的权限，菜单的受保护的属性
    protected $admin = array();

    // 是否需要认证，超级管理员无须认证，其他管理员则需要认证
    protected $is_need_certificated = true;

    // 构造方法
    public function __construct() {
        parent::__construct();

        // 判断用户是否登录
        $adminInfo = session('adminInfo');
        if(!$adminInfo){
            $this->error('请先登录!',U('Login/login'));
        }

        // 使用默认的文件缓存缓存用户数据，权限集，菜单集
        $this->admin = S('admin_'.$adminInfo['admin_id']);
        if(!$this->admin){
            // echo 'FileCached';
            // 存储管理员的基本信息
            $this->admin['baseInfo'] = $adminInfo;
            // 权限认证过程
            // 1.获取权限集
            if ($this->admin['baseInfo']['role_id'] == 1) {
                // 超级管理员角色
                $accesses = M('Access')->select();
            } else {
                // 普通角色
                $roleInfo = M('Role')->field('access_ids')->where('role_id=' . $this->admin['baseInfo']['role_id'])->find();
                $access_ids = explode(',', $roleInfo['access_ids']);
                $accesses = M('Access')->where(array('access_id' => array('in', $access_ids)))->select();
            }
            // 2.组装权限集以及组装菜单集
            foreach ($accesses as $k => $v) {
                $this->admin['access'][] = strtolower($v['access_string']);
                // 考虑到菜单是否导航显示is_show 1显示 0不显示
                if ($v['is_show'] == 1) {
                    $this->admin['menus'][] = $v;
                }
            }
            // 将从数据库获取到的数据写入缓存文件中
            S('admin_'.$adminInfo['admin_id'],$this->admin);
        }
        // 超级管理员角色用户不用认证
        if($adminInfo['role_id'] == 1){
            $this->is_need_certificated = false;
        }
        // 3.完成认证工作
        if ($this->is_need_certificated) {
            // 给普通角色设置默认访问权限和默认菜单
            $this->admin['access'][] = 'backstage/index/index';
            $this->admin['access'][] = 'backstage/index/top';
            $this->admin['access'][] = 'backstage/index/menu';
            $this->admin['access'][] = 'backstage/index/main';
            $this->admin['access'][] = 'backstage/index/clear_cache';

            $action_string = strtolower(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);
            if (!in_array($action_string, $this->admin['access'])) {
                if (IS_AJAX) {
                    $this->ajaxReturn(array('status' => 0, 'msg' => '不好意思，么有权限咧'));
                } else {
                   $this->error('不好意思，么有权限咧');
                }
            }
        }
    }

    /**
     * 获取数据表的所有字段信息，以‘a','b','c'.的格式
     * @param array $array 为索引数组
     * @return string
     */
    protected function getFieldsToSting($array=array()){
        $res = '';
        foreach($array as $k=>$v){
            $res.= "'".$v."',";
        }
        return $res;
    }

    // 添加空操作方法，提升用户体验
    protected function _empty(){
        echo '该系统的模块('.MODULE_NAME.')下的控制器('.CONTROLLER_NAME.')中没有实现您访问的操作('.ACTION_NAME.')，请检查系统代码！';
    }
}

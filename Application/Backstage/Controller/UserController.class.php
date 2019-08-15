<?php
/**
 * 后台用户控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/15
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

/**
 * Class UserController
 * 定义后台用户控制器类
 * @package Backstage\Controller
 */
class UserController extends BaseController {

    // 用户列表
    public function index(){
        // 处理搜索用户的条件

        $this->display();
    }

    // 添加用户
    public function add(){
        $this->display();
    }

    // 修改用户信息
    public function edit(){
        $this->display();
    }

    // 删除用户信息
    public function del(){

    }

}
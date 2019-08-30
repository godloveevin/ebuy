<?php
/**
 * 后台登录控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/24
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;
use \Think\Controller;
use \Think\Verify;

/**
 * Class LoginController
 * 定义后台登录控制器类
 * @package Backstage\Controller
 */
class LoginController extends Controller {

    //登录操作
    public function login(){
        if(IS_GET){
            $this->display();
        }else{
            // 登录处理
            // 1.接收用户登录数据
            $data = I('post.');
            // 2.验证验证码
            $verify = new Verify();
            $res = $verify->check($data['captcha']);
            if(!$res){
                $this->error('验证码有误');
            }
            // 3.用户名验证
            $adminInfo = D('Admin')->where("admin_name='".$data['username']."'")->find();
            if(!$adminInfo){
                $this->error('用户不存在!');
            }
            // 4.判断密码是否正确
            if($adminInfo['password'] != md5($data['password'].md5($adminInfo['eb_salt']))){
                $this->error('密码错误!');
            }

            // 更新登录用户的登录信息（登录ip，登录时间，登录次数）
            $update_data['admin_id'] = $adminInfo['admin_id'];
            $update_data['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
            $update_data['last_login_time'] = time();
            $update_data['login_times'] = $adminInfo['login_times'] + 1;//dump($update_data);die;
            if(!D('Admin')->save($update_data)){
                $this->error('更新登录信息失败!');
            }

            // 登录成功之后
            session('adminInfo',$adminInfo);

            $this->success('ok!',U('Backstage/Index/index'));
        }
    }

    /**
     * 生成验证码
     */
    public function cpatcha(){
        $verify = new Verify();
        $verify->fontSize = 18;
        $verify->length   = 3;
        // $verify->useImgBg = true;
        $verify->imageH = 34;
        $verify->imageW = 102;
        $verify->entry();
    }

    // 退出操作
    public function logout(){
        session('adminInfo',null);
        // 删除seesion文件
        session_destroy();
        //删除session对应的cookie值
        setcookie(session_name(),false);
        $this->success('ok！',U('Login/login'));
    }
}
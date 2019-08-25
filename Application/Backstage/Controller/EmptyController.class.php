<?php
/**
 * 后台空控制器类文件
 * @author  godloveevin
 * @D/T 2019/08/26
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Controller;

/**
 * Class EmptyController
 * 定义后台的空控制器，提升用户体验
 * @package Backstage\Controller
 */
class EmptyController extends BaseController {
    // 定义空操作
    public function _empty(){
        echo '您访问了一个您没定义的控制器，建议您检查系统!';
    }

}
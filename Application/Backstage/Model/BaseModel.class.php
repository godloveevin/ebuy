<?php
/**
 * 后台模型基础类文件
 * @author  godloveevin
 * @D/T 2019/08/15
 * @Email   godloveevin@yeah.net
 */
namespace Backstage\Model;

use Think\Model;

/**
 * Class BaseModel
 * 定义模型基础类
 * @package Backstage\Model
 */
class BaseModel extends Model {

    // 根据id获取一行数据
    public function findOneById($id){
        return $this->where('id='.$id)->find();
    }

}
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

    // 获取总记录数
    private function _getTotal($where=''){
        $res = $this->where($where)->count();
        return $res;
    }

    // 获取分页数据
    protected function getPageData($where=''){
        // 处理分页条件
        $cur_page = I('get.p',1);//当前页，默认取
        $total = $this->_getTotal($where);// 总记录数
        $page_size = C('PAGE_SIZE');//每页显示的条目数
        $total_pages = ceil($total/$page_size);//总页数
        // 组装页码url
        $firstPageUrl = U(ACTION_NAME,'p=1'); // 首页
        $lastPageUrl = U(ACTION_NAME,'p='.$total_pages); // 尾页
        if(($cur_page > 1) && ($cur_page <= $total_pages)) {
            $prevPageUrl = U(ACTION_NAME,'p='.($cur_page-1));
        }else{
            $prevPageUrl = 0;
        }//上一页
        if(($cur_page >= 1) && ($cur_page < $total_pages)){
            $nextPageUrl = U(ACTION_NAME,'p='.($cur_page+1));
        }else{
            $nextPageUrl = 0;
        }//下一页

        return array(
            'curPage' => $cur_page,
            'total'=> $total,
            'pageSize'=>$page_size,
            'totalPages' => $total_pages,
            'firstPageUrl'=>$firstPageUrl,
            'lastPageUrl'=>$lastPageUrl,
            'prevPageUrl'=>$prevPageUrl,
            'nextPageUrl'=>$nextPageUrl,
        );
    }

}
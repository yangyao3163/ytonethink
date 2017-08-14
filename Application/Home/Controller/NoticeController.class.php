<?php


namespace Home\Controller;


class NoticeController extends HomeController
{
    public function index(){

        /* 获取频道列表 */
        $map  = array('category_id'=>42);

        $list = M('Document')->where($map)->select();
       // var_dump($list);exit;
        $this->assign('list', $list);
        $this->display('notice');
    }
}
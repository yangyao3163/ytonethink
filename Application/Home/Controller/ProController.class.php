<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/11
 * Time: 15:07
 */

namespace Home\Controller;


use Think\Controller;

class ProController extends HomeController
{
    public function add(){
        if(IS_POST){
            $Pro = D('Pro');
            $data = $Pro->create();
            $Pro->odd=uniqid();
            if($data){
                $id = $Pro->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_pro', 'pro', $id, UID);
                    $this->redirect('Pro/online');
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Pro->getError());
            }
        } else {
            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('pro')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }

            $this->assign('pid', $pid);
            $this->assign('info',null);
            $this->display('online');
        }
    }

}
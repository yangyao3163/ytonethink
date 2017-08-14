<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/8/10
 * Time: 15:52
 */

namespace Home\Controller;


class PropertyController extends HomeController
{
    /**
     * 添加频道
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function add(){
        if(IS_POST){
            $Property = D('Property');
            $data = $Property->create();
//            $Property->number = uniqid();
            if($data){
                $id = $Property->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_property', 'property', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Property->getError());
            }
        } else {
            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('Property')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }
            $this->assign('pid', $pid);
            $this->assign('info',null);
            $this->meta_title = '新增报修';
            $this->display('index');
        }
    }


}
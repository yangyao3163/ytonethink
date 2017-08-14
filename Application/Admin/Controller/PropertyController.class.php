<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/8/10
 * Time: 15:52
 */

namespace Admin\Controller;


class PropertyController extends AddonsController
{
    /**
     * 频道列表
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        /* 查询条件初始化 */
//        $pid = i('get.pid', 0);
        $map = array();
        /* 获取频道列表 */
        $map  = array('status' => array('gt', -1));
        if(isset($_GET['name'])){
            $map['name']    =   array('like', '%'.(string)I('name').'%');
        }
        $list = $this->lists('Property', $map,'id asc');
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->assign('list', $list);
        $this->meta_title = '报修管理';
        $this->display();
    }

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
            $this->display('edit1');
        }
    }

    /**
     * 编辑频道
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function edit1($id = 0){
        if(IS_POST){
            $Property = D('Property');
            $data = $Property->create();
            if($data){
                if($Property->save()){
                    //记录行为
                    action_log('update_property', 'property', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Property->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Property')->find($id);
//            var_dump($info);exit;

            if(false === $info){
                $this->error('获取配置信息错误');
            }

            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('Property')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }
            $this->assign('pid', $pid);
            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            $this->display();
        }
    }

    /**
     * 删除频道
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Property')->where($map)->delete()){
            //记录行为
            action_log('update_property', 'property', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }


    /**
     * 查看行为日志
     * @author huajie <banhuajie@163.com>
     */
    public function edit($id = 0){
        empty($id) && $this->error('参数错误！');

        $info = M('Property')->field(true)->find($id);

        $this->assign('info', $info);
        $this->meta_title = '查看详细问题';
        $this->display();
    }

}
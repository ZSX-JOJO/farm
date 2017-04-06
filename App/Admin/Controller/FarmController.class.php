<?php

namespace Admin\Controller;

use Admin\Controller\CommonController;

class FarmController extends CommonController {

    public function shop() {


        if (!empty($_REQUEST['search_type'])) {
            $map['type'] = $_REQUEST['search_type'];
            $search['search_type'] = $_REQUEST['search_type'];
        }

        $framshop_table = M('framshop');
        $count = $framshop_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $framshop_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();

        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);
        $shopType = getShopType();
        $this->assign('type', $shopType);

        $this->display();
    }

    public function shopedit() {
        $framshop_table = M('framshop');

        if (IS_AJAX) {
            $id = I('post.id');
            $title = I('post.title');
            $money = I('post.money');
            $sellmoney = I('post.sellmoney');
            $number = I('post.number');
            $hour = I('post.hour');
            $integral = I('post.integral');
            $experience = I('post.experience');
            $sellmoney = $sellmoney != null ? $sellmoney : 0;
            $data = array(
                'id' => $id,
                'title' => $title,
                'money' => $money,
                'sellmoney' => $sellmoney,
                'hour' => $hour,
                'integral' => $integral,
                'experience' => $experience,
                'number'=>$number
            );
            $relust = $framshop_table->save($data);
            if ($relust) {
                showMsg(1, '修改成功');
            } else {
                showMsg(2, '操作失败');
            }
        }


        $id = I('get.id');
        $shopInfo = $framshop_table->find($id);
        $this->assign('shopinfo', $shopInfo);
        $this->display();
    }

    //仓库管理
    public function depot() {
        $member_table = M('member');
        if (!empty($_REQUEST['username'])) {
            $userinfo = $member_table->field('id')->where(array('username' => $_REQUEST['username']))->find();
            $map['uid'] = $userinfo['id'];
            $search['username'] = $_REQUEST['username'];
        }

        $framshop_table = M('framshop');
        $framdepot_table = M('framdepot');
        
       $map['type']=1;
        //总价值
        $shopinfo=$framshop_table->where(array('type'=>1))->select();
        $counts=  count($shopinfo);
        $total=0;
        for($i=0;$i<$counts;$i++){
             $map['shopid']=$shopinfo[$i]['id'];
             $number1=$framdepot_table->where($map)->sum('number');//玫瑰的总数量
             $total+=$number1*$shopinfo[$i]['sellmoney'];
        }
        unset($map['shopid']);
        $count = $framdepot_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $framdepot_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $lcount = count($list);
        for ($i = 0; $i < $lcount; $i++) {
            $user = $member_table->field('username')->find($list[$i]['uid']);
            $list[$i]['username'] = $user['username'];
            $shopInfo = $framshop_table->field('title,large')->find($list[$i]['shopid']);
            $list[$i]['title'] = $shopInfo['title'];
            $list[$i]['large'] = $shopInfo['large'];
        }
        $this->assign('total',$total);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);

        $this->display();
    }

    //种植记录
    public function grow() {

          if (!empty($_REQUEST['search_starttime']) && !empty($_REQUEST['search_endtime'])) {
            $startime = strtotime($_REQUEST['search_starttime']);
            $endtime = strtotime($_REQUEST['search_endtime']);

            if ($startime <= $endtime) {
                $times = (strtotime($_REQUEST['search_starttime'] . '00:00:00') . ',' . strtotime($_REQUEST['search_endtime'] . '23:59:59'));
                $search['search_starttime'] = $_REQUEST['search_starttime'];
                $search['search_endtime'] = $_REQUEST['search_endtime'];
            } else {
                $times = (strtotime($_REQUEST['search_endtime'] . '00:00:00') . ',' . strtotime($_REQUEST['search_starttime'] . '23:59:59'));
                $search['search_starttime'] = $_REQUEST['search_endtime'];
                $search['search_endtime'] = $_REQUEST['search_starttime'];
            }
            $map['create_date'] = array('between', $times);
            //$timespan = strtotime(urldecode($_REQUEST['start_time'])) . "," . strtotime(urldecode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        $member_table=M('member');
        if (!empty($_REQUEST['username'])) {
            $userinfo = $member_table->field('id')->where(array('username' => $_REQUEST['username']))->find();
            $map['uid'] = $userinfo['id'];
            $search['username'] = $_REQUEST['username'];
        }
        
        
        
        
        
        
        
        
        $framshop_table=M('framshop');
       
        
        
        $framgrow_table = M('framgrow');
        $count = $framgrow_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $framgrow_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $lcount = count($list);
        for ($i = 0; $i < $lcount; $i++) {
            $user = $member_table->field('username')->find($list[$i]['uid']);
            $list[$i]['username'] = $user['username'];
            $shopInfo = $framshop_table->field('title,thumb')->find($list[$i]['shopid']);
            $list[$i]['title'] = $shopInfo['title'];
            $list[$i]['thumb'] = $shopInfo['thumb'];
        }

        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);
        $this->display();
    }

    //停用
    public function shop_stop() {

        $framshop_table = M('framshop');
        $relsult = $framshop_table->where('id=' . I('get.id'))->find();
        if ($relsult['status'] == 1) {
            $data['id'] = I('get.id');
            $data['status'] = 2;
            $rel1 = $framshop_table->save($data);
            if ($rel1) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

//启用

    public function shop_start() {

        $framshop_table = M('framshop');
        $relsult = $framshop_table->where('id=' . I('get.id'))->find();
        if ($relsult['status'] == 2) {
            $data['id'] = I('get.id');
            $data['status'] = 1;
            $rel1 = $framshop_table->save($data);
            if ($rel1) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

}

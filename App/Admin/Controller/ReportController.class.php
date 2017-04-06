<?php

namespace Admin\Controller;

use Admin\Controller\CommonController;

class ReportController extends CommonController {

    
     public function total() {

        $member_table = M('member');
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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }

 
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }


        $total_table = M('total');
        $count =$total_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $total_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
      
        }


        $this->assign('type', purseType());
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('arr', $search);
        $this->display();
    }
    public function recharge() {

        $member_table = M('member');
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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_status'])) {
            $map['status'] = $_REQUEST['search_status'];
            $search['search_status'] = $_REQUEST['search_status'];
        }
        if (!empty($_REQUEST['search_type'])) {

            $map['type'] = $_REQUEST['search_type'];
            $search['search_type'] = $_REQUEST['search_type'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }


        $recharge_table = M('recharge');
        $count = $recharge_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $recharge_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
            $admininfo = M('admin')->field('username')->find($list[$i]['admin_id']);
            $list[$i]['adminname'] = $admininfo['username'];
        }


        $this->assign('type', purseType());
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('arr', $search);
        $this->display();
    }

    public function zijinlist() {
        $member_table = M('member');
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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_status'])) {
            $map['status'] = $_REQUEST['search_status'];
            $search['search_status'] = $_REQUEST['search_status'];
        }
        if (!empty($_REQUEST['search_type'])) {

            $map['type'] = $_REQUEST['search_type'];
            $search['search_type'] = $_REQUEST['search_type'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }


        $bonus_table = M('bonus');
        $count = $bonus_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $bonus_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
        }

        $this->assign('type', purseType());
        $this->assign('bonusType', getBonusType());
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('arr', $search);
        $this->display();
    }

    public function touzishouyi() {
        $member_table = M('member');
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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }


        $invest_table = M('invest');
        $count = $invest_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $invest_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
        }

        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('arr', $search);
        $this->display();
    }

    public function chongzhilist() {

        $member_table = M('member');
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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }
        if (!empty($_REQUEST['search_status'])) {
            $map['status'] = $_REQUEST['search_status'];
            $search['search_status'] = $_REQUEST['search_status'];
        } else {
            $map['status'] = 1;
            $search['search_status'] = 1;
        }
        $admin_table = M('admin');
        $chongzhi_table = M('chongzhi');
        $count = $chongzhi_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $chongzhi_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
            if (!empty($list[$i]['admin_id'])) {
                $adminInfo = $admin_table->find($list[$i]['admin_id']);
                $list[$i]['admin'] = $adminInfo['username'];
            }
        }
        $this->assign('status', getChongzhiBonusStatus());
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('arr', $search);
        $this->display();
    }

    public function tuijianbonus() {
        $member_table = M('member');
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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }



        $map['type'] = 1;
        $bonusshouyi_table = M('bonusshouyi');
        $count = $bonusshouyi_table->where($map)->count();
        $Page = new \Think\Page($count, 50);
        $show = $Page->show();
        $list = $bonusshouyi_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
        }
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('arr', $search);
        $this->display();
    }

      public function tuanduibonus() {
        $member_table = M('member');
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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }



        $map['type'] =2;
        $bonusshouyi_table = M('bonusshouyi');
        $count = $bonusshouyi_table->where($map)->count();
        $Page = new \Think\Page($count, 50);
        $show = $Page->show();
        $list = $bonusshouyi_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
        }
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('arr', $search);
        $this->display();
    }
    
    public function tixianlist() {
        $member_table = M('member');

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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_type'])) {

            $map['pursetype'] = $_REQUEST['search_type'];
            $search['search_type'] = $_REQUEST['search_type'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }
        if (!empty($_REQUEST['search_status'])) {
            $map['status'] = $_REQUEST['search_status'];
            $search['search_status'] = $_REQUEST['search_status'];
        } else {
            $map['status'] = 1;
            $search['search_status'] = 1;
        }
        $admin_table = M('admin');
        $tixian_table = M('tixian');
        $count = $tixian_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $tixian_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['zhanghao'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
            if (!empty($list[$i]['admin_id'])) {
                $adminInfo = $admin_table->find($list[$i]['admin_id']);
                $list[$i]['admin'] = $adminInfo['username'];
              
            }  $list[$i]['sum']=$list[$i]['money']-$list[$i]['poundage'];
        }
      
        $this->assign('status', getTixianBonusStatus());
        $this->assign('type', getBonusType());
        $this->assign('types', purseType());
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('arr', $search);
        $this->display();
    }
    
    public function  touzilist(){
        
        
        $member_table = M('member');
        $invest_table=M('invest');

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
            //$timespan = strtotime(urlderode($_REQUEST['start_time'])) . "," . strtotime(urlderode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['create_date'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['create_date'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_type'])) {

            $map['pursetype'] = $_REQUEST['search_type'];
            $search['search_type'] = $_REQUEST['search_type'];
        }
        if (!empty($_REQUEST['search_username'])) {

            $info = $member_table->field('id')->where(array('username' => trim($_REQUEST['search_username'], " ")))->find();
            $map['uid'] = $info['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }
        if (!empty($_REQUEST['search_status'])) {
            $map['status'] = $_REQUEST['search_status'];
            $search['search_status'] = $_REQUEST['search_status'];
        } else {
            $map['status'] = 1;
            $search['search_status'] = 1;
        }
        $admin_table = M('admin');
        
        $count = $invest_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 50); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $invest_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $rcount = count($list);
        for ($i = 0; $i < $rcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
            if (!empty($list[$i]['admin_id'])) {
                $adminInfo = $admin_table->find($list[$i]['admin_id']);
                $list[$i]['admin'] = $adminInfo['username'];
              
            }  
        }
      
        $this->assign('status', getTixianBonusStatus());
        $this->assign('type', getBonusType());
        $this->assign('types', purseType());
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('arr', $search);
        $this->display();
    }

    //确认收款
    public function ConfirmReceipt() {
        $id = I('post.id', '', 'htmlspecialchars');
        $chongzhi_table = M('chongzhi');
        $member_table = M('member');
        $bonus_table = M('bonus');
        $recharge_table = M('recharge');
        $member_table->startTrans();
        $row = $chongzhi_table->where(array('status' => '1', 'id' => $id))->find();
        if (!$row) {
            showMsg(2, '已经充值过了');
        }
        $userInfo = $member_table->find($row['uid']);
        $usermoney = $userInfo['principal'] + $row['money'];
        $rel1 = $member_table->save(array('id' => $row['uid'], 'principal' => $usermoney));
        $rel2 = $bonus_table->add(array('uid' => $row['uid'], 'sum' => $row['money'], 'balance' => $usermoney, 'explain' => '线下充值', 'admin_id' => $_SESSION['userid'], 'type' => '1', 'create_date' => time()));
        $rel3 = $chongzhi_table->save(array('id' => $id, 'status' => '2', 'admin_id' => $_SESSION['userid'], 'replace_date' => time()));
        $rel4 = $recharge_table->add(array('uid' => $row['uid'], 'type' => 1, 'number' => $row['money'], 'admin_id' => session('userid'), 'status' => 1, 'create_date' => time()));

        if ($rel1 && $rel2 && $rel3 && $rel4) {
            $member_table->commit();
            showMsg(1, '操作成功');
        } else {
            $member_table->rollback();
            showMsg(2, '操作失败');
        }
    }

    //拒绝收款
    public function RefuseCollection() {
        $id = I('post.id', '', 'htmlspecialchars');
        $chongzhi_table = M('chongzhi');
        $rel = $chongzhi_table->save(array('id' => $id, 'status' => '3', 'admin_id' => $_SESSION['userid'], 'replace_date' => time()));
        if ($rel) {
            showMsg(1, '操作成功');
        } else {
            showMsg(2, '操作失败');
        }
    }

    //确认打款
    public function FinishedPlaying() {
        $id = I('post.id', '', 'htmlspecialchars');
        $tixian_table = M('tixian');
        $rel = $tixian_table->save(array('id' => $id, 'status' => '2', 'admin_id' => $_SESSION['userid'], 'replace_date' => time()));
        if ($rel) {
            showMsg(1, '操作成功');
        } else {
            showMsg(2, '操作失败');
        }
    }

    //拒绝打款
    public function RefuseToPlay() {
        $id = I('post.id', '', 'htmlspecialchars');
        $tixian_table = M('tixian');
        $bonus_table = M('bonus');
        $member_table = M('member');
        $member_table->startTrans();
        $row = $tixian_table->find($id);
        $userInfo = $member_table->find($row['uid']);
        switch ($row['pursetype']) {
            case 1:
                $usermoney = $userInfo['principal'] + $row['money'] ;
                $rel1 = $member_table->save(array('id' => $row['uid'], 'principal' => $usermoney));
                break;
            case 2:
                $usermoney = $userInfo['profit'] + $row['money'];
                $rel1 = $member_table->save(array('id' => $row['uid'], 'profit' => $usermoney));
                break;
            default :
                showMsg(2, '操作失败');
        }

        $rel3 = $bonus_table->add(array('uid' => $row['uid'], 'sum' => $row['money'] , 'status' => 1, 'balance' => $usermoney, 'explain' => '拒绝提现', 'type' => $row['pursetype'], 'source' => '3', 'admin_id' => $_SESSION['userid'], 'create_date' => time()));
        $rel2 = $tixian_table->save(array('id' => $id, 'status' => '3', 'admin_id' => $_SESSION['userid'], 'replace_date' => time()));
        if ($rel1 && $rel2 && $rel3) {
            $member_table->commit();
            showMsg(1, '操作成功');
        } else {
            $member_table->rollback();
            showMsg(2, '操作失败');
        }
    }

}

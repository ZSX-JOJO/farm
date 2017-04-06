<?php

namespace Home\Controller;

use Home\Controller\CommonController;

class FarmController extends CommonController {

    //种植记录
    public function grow() {

        $uid = session('uid');
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

        $map['uid'] = $uid;
        $framshop_table = M('framshop');

        $framgrow_table = M('framgrow');
        $count = $framgrow_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 7); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $framgrow_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $lcount = count($list);
        for ($i = 0; $i < $lcount; $i++) {

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

    //偷
    public function steal() {

        $uid = session('uid');
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

        $map['fid'] = $uid;
        $map['type'] = 1;
        $framshop_table = M('framshop');
        $member_table = M('member');
        $framdetail_table = M('framdetail');
        $count = $framdetail_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 7); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $framdetail_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $lcount = count($list);
        for ($i = 0; $i < $lcount; $i++) {
            $user = $member_table->find($list[$i]['uid']);
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

    //摘
    public function pick() {
        $uid = session('uid');
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

        $map['uid'] = $uid;
        $framshop_table = M('framshop');
        $member_table = M('member');
        $framdetail_table = M('framdetail');
        $count = $framdetail_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 7); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $framdetail_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $lcount = count($list);
        for ($i = 0; $i < $lcount; $i++) {
            $user = $member_table->find($list[$i]['fid']);
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

}

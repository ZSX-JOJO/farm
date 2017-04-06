<?php

namespace Admin\Controller;

use Admin\Controller\CommonController;

class MessageController extends CommonController {
    /*     * *
     *
     * 留言
     */

    public function index() {


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
            $map['addtime'] = array('between', $times);
            //$timespan = strtotime(urldecode($_REQUEST['start_time'])) . "," . strtotime(urldecode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['addtime'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['addtime'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_username'])) {
            $user = M('member')->field('id')->where(array('username' => $_REQUEST['search_username']))->find();
            $map['uid'] = $user['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }
        if (!empty($_REQUEST['search_type'])) {
            $map['type'] = $_REQUEST['search_type'];
            $search['search_type'] = $_REQUEST['search_type'];
        }
        if (!empty($_REQUEST['search_status'])) {
            if ($_REQUEST['search_status'] == 1) {
                $map['status'] = array('neq', '3');
            } else if ($_REQUEST['search_status'] == 2) {
                $map['status'] = array('eq', '3');
            } else {
                $map['status'] = array('eq', '1,2,3');
            }
            $search['search_status'] = $_REQUEST['search_status'];
        }

        
        $message_table = M('message');
        $member_table = M('member');
        $count = $message_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $list = $message_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $fcount = count($list);
        for ($i = 0; $i < $fcount; $i++) {
            $userinfo = $member_table->field('username,name,mobile,email')->find($list[$i]['uid']);
            $list[$i]['username'] = $userinfo['username'];
            $list[$i]['name'] = $userinfo['name'];
            $list[$i]['mobile'] = $userinfo['mobile'];
            $list[$i]['email'] = $userinfo['email'];
           
        }


        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);
        $this->display();
    }

    //删除留言
    public function messageDel() {
        $message_table = M('message');
        $relsult = $message_table->where('id=' . I('get.id'))->delete();
        if ($relsult) {
           showMsg(1, '操作成功');
        } else {
           showMsg(2, '操作失败');
        }
    }

    //批量删除留言
    public function datadelMessage() {
        $member = M('message');
        $str = I('get.str');
        $str = rtrim($str, ',');
        unset($data);
        $data['id'] = array('in', $str);
        $relsult = $member->where($data)->delete();
        if ($relsult) {
            showMsg(1, '操作成功');
        } else {
          showMsg(2, '操作失败');
        }
    }

    //查看留言
    public function messageedit() {
        $message_table = M('message');
        $member_table = M('member');

        if (IS_GET) {
            $id = I('get.id');
            $data['id'] = $id;
            $message_table->save(array('id' => $id, 'status' => '2'));
        }
        if (IS_POST) {
            $id = I('post.id');
            $data['id'] = $id;
            $reply = I('post.reply');
            $result = $message_table->save(array('id' => $id, 'status' => '3', 'reply' => $reply, 'replytime' => time()));
            if ($result) {
                showMsg(1, '操作成功');
            } else {
               showMsg(2, '操作成功');
            }
        }
        $message_row = $message_table->field('id,subject,content,reply,picture')->where($data)->find();
        $userinfo = $member_table->field('username')->find($message_row['uid']);
        $this->assign('userinfo', $userinfo);
        $this->assign('message_row', $message_row);
        $this->display();
    }

}

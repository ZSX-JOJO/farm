<?php

namespace Admin\Controller;

use Admin\Controller\CommonController;

class MemberController extends CommonController {
    /*     * *
     *
     * 会员中心
     */

    public function index() {

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
            $map['regtime'] = array('between', $times);
            //$timespan = strtotime(urldecode($_REQUEST['start_time'])) . "," . strtotime(urldecode($_REQUEST['end_time']));
        } elseif (!empty($_REQUEST['search_starttime'])) {
            $xtime = strtotime($_REQUEST['search_starttime'] . '00:00:00');
            $map['regtime'] = array("egt", $xtime);
            $search['search_starttime'] = $_REQUEST['search_starttime'];
        } elseif (!empty($_REQUEST['search_endtime'])) {
            $xtime = strtotime($_REQUEST['search_endtime'] . '23:59:59');
            $map['regtime'] = array("elt", $xtime);
            $search['search_endtime'] = $_REQUEST['search_endtime'];
        }
        if (!empty($_REQUEST['search_username'])) {
            $map['username'] = $_REQUEST['search_username'];
            $search['search_username'] = $_REQUEST['search_username'];
        }
        if (!empty($_REQUEST['search_status'])) {
            $map['status'] = $_REQUEST['search_status'];
            $search['search_status'] = $_REQUEST['search_status'];
        } else {
            $map['status'] = 1;
            $search['search_status'] = 1;
        }

                
        $relust = rewardset();
        $level = explode(',', $relust['level']);
        $benjin=$member_table->sum('principal');
       
        
        $count = $member_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 30); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $member_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $allcount = count($list);

        for ($i = 0; $i < $allcount; $i++) {
            $list[$i]['star'] = $level[$list[$i]['star']];
            $re_info = $member_table->field('username,name')->find($list[$i]['recommend']);
            $list[$i]['estate'] = $estate[$list[$i]['estate']];
            if ($re_info) {
                $list[$i]['recommend'] = $re_info['username'];
                $list[$i]['recommendname'] = $re_info['name'];
            } else {
                $list[$i]['recommend'] = '无';
                $list[$i]['recommendname'] = '无';
            }
        }

        $this->assign('benjin',$benjin);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);
        $this->display();
    }

    //冻结日志
    public function frozenlog() {
        $member_table = M('member');
        $admin_table = M('admin');
        $frozenlog_table = M('frozenlog');
        if (!empty($_REQUEST['search_username'])) {
            $userinfo = $member_table->field('id')->where(array('username' => $_REQUEST['search_username']))->find();
            $map['uid'] = $userinfo['id'];
            $search['search_username'] = $_REQUEST['search_username'];
        }
        $count = $frozenlog_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 30); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $frozenlog_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $allcount = count($list);
        $type = array('系统自动冻结', '后天人工冻结');
        for ($i = 0; $i < $allcount; $i++) {

            $u_info = $member_table->field('username,name,mobile')->find($list[$i]['uid']);
            if ($list[$i]['type'] != 0) {
                $relust = $a_info = $admin_table->field('username')->find($list[$i]['admin_id']);
                $list[$i]['adminusername'] = $relust['username'];
            } else {
                $list[$i]['adminusername'] = '系统自动冻结';
            }
            $list[$i]['name'] = $u_info['name'];
            $list[$i]['username'] = $u_info['username'];
            $list[$i]['mobile'] = $u_info['mobile'];
        }

        $this->assign('type', $type);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $allcount);
        $this->assign('arr', $search);
        $this->display();
    }

    //下载Excel
    public function downloadexcel() {
        $status = array('1' => '正常', '2' => '删除', '3' => '冻结');
        $member_table = M('member');
        $xlsName = "会员列表"; //设置要导出excel的表头 
        $xlsCell = array(
            array('id', '会员id'),
            array('username', '账号'),
            array('name', '账户姓名'),
            array('mobile', '手机号码'),
            array('recommend', '推荐人'),
            array('recommendname', '推荐人姓名'),
            array('directnum', '直线人数'),
            array('group', '组数'),
            array('regtime', '注册时间'),
            array('status', '状态'),
        );

        $xlsModel = M('member');
        $xlsData = $xlsModel->Field('id,username,name,mobile,recommend,directnum,group,regtime,status')->select();
        $xlscount = count($xlsData);
        for ($i = 0; $i < $xlscount; $i++) {
           
            $userinfo = $member_table->field('username,name')->find($xlsData[$i]['recommend']);
            $xlsData[$i]['recommend'] = $userinfo['username'];
            $xlsData[$i]['recommendname'] = $userinfo['name'];
            $xlsData[$i]['bankno'] = ' ' . $xlsData[$i]['bankno'];
            $xlsData[$i]['regtime'] = date('Y-m-d H:i:s', $xlsData[$i]['regtime']);
            $xlsData[$i]['status'] = $status[$xlsData[$i]['status']];
            if ($xlsData[$i]['recommend'] == 0) {
                $xlsData[$i]['recommend'] = '无';
                $xlsData[$i]['recommendname'] = '无';
            }
        }
        $this->exportExcel($xlsName, $xlsCell, $xlsData);
    }

    //删除用户
    public function userDel() {
        $member_table = M('member');
        $id = I('get.id');
        $userinfo = $member_table->field('recommend,status')->find($id);
        $relust = $member_table->save(array('id' => $id, 'status' => '2'));
        if ($relust) {
            showMsg(1, '操作成功');
        } else {
            showMsg(2, '操作失败');
        }
    }

    //修改用户密码
    public function userpasswordedit() {
        if (IS_POST) {
            $id = I('post.id');
            $newpwd = I('post.newpassword', '', 'trim');
            if (!empty($newpwd)) {
                $data['id'] = $id;
                $data['password'] = md5pwd(1, $newpwd);
                $relust = M('member')->save($data);
                if ($relust) {
                    showMsg(1, '操作成功');
                } else {
                    showMsg(2, '操作失败');
                }
            } else {
                showMsg(2, '密码不能为空!');
            }
        } else {

            $id = I('get.id');
            $this->assign('id', $id);
            $this->display();
        }
    }

    //修改用户二级密码
    public function usertowpasswordedit() {
        if (IS_POST) {
            $id = I('post.id');
            $newpwd = I('post.townewpassword', '', 'trim');
            if (!empty($newpwd)) {
                $data['id'] = $id;
                $data['towlevelpassword'] = md5pwd(1, $newpwd);
                $relust = M('member')->save($data);
                if ($relust) {
                    showMsg(1, '操作成功');
                } else {
                    showMsg(2, '操作失败');
                }
            } else {

                showMsg(2, '密码不能为空!');
            }
        } else {

            $id = I('get.id');
            $this->assign('id', $id);
            $this->display();
        }
    }

    //修改用户信息
    public function useredit() {
        $member = M('member');
        if (IS_POST) {

            $username_info = $member->field('id,username')->where(array('username' => $_POST['username']))->find();
            $mobile_info = $member->field('id,mobile')->where(array('mobile' => $_POST['mobile']))->find();
            if ($username_info) {
                
                $dd=$_POST;
                if ($username_info['id'] != $_POST['id']) {
                    showMsg(2, '账号已经存在，请换一个!');
                }
            }
            if ($mobile_info) {
                if ($mobile_info['id'] != $_POST['id']) {
                    showMsg(2, '手机号已经存在，请换一个!');
                }
            }
            
            $rel = $member->save($_POST);
            if ($rel) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        } else {


            $id = I('get.id');
            $data['id'] = $id;
            $member_row = $member->where($data)->find();
            $bank_table = M('bank');
            $bank_list = $bank_table->order('sort desc')->where(array('is_hied' => '1'))->select();
            $this->assign('banklist', $bank_list);

            $relust = rewardset();
            $level = explode(',', $relust['level']);
            $this->assign('level', $level);
            $this->assign('id', $id);
            $this->assign('member_row', $member_row);
            $this->display();
        }
    }

    //用户详情
    public function usershow() {
        $member_table = M('member');
        $id = I('get.id');
        $data['id'] = $id;
        $member_row = $member_table->where($data)->find();
        $re_info = $member_table->field('username')->find($member_row['recommend']);
        if ($re_info) {
            $member_row['recommend'] = $re_info['username'];
        } else {
            $member_row['recommend'] = '无';
        }

        $this->assign('member_row', $member_row);
        $this->display();
    }

    //停用用户
    public function user_stop() {

        $member = M('member');
        $id = I('get.id');
        $relsult = $member->where(array('id' => $id))->find();
        if ($relsult['status'] == 1) {
            $data['id'] = $id;
            $data['status'] = 3;
            $rel1 = $member->save($data);
            if ($rel1) {
                freezelog($id, '平台冻结', '1', $_SESSION['userid']);

                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

//启用用户

    public function user_start() {
        $bonusrelust = bonusset();
        $member = M('member');
        $id = I('get.id');
        $relsult = $member->find($id);
        if ($relsult['status'] == 3 or $relsult['status'] == 2) {
            $data['id'] = $id;
            $data['frozentime'] = time() + 60 * 60 * 24;
            $data['status'] = 1;
            $rel1 = $member->save($data);
            if ($rel1) {
                freezelog($id, '平台解冻', '1', $_SESSION['userid']);
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

    //添加用户
    public function useradd() {
        $member_table = M('member');
        $member_table->startTrans();
        if (IS_POST) {
            $count = $member_table->find();
            if ($count>6) {
                showMsg(2, '已经添加了'.$count.'个顶级用户，无法注册');
            }
            $_POST['regtime'] = time();
            $_POST['password'] = md5pwd(1, $_POST['password']);
        
            $_POST['towlevelpassword'] = md5pwd(1, $_POST['towlevelpassword']);
            $_POST['regip'] = get_client_ip(0, true);
            $_POST['frozentime'] = time() + 60 * 60 * 24;
            $_POST['month_start_time'] = time();
            $mobile_info = $member_table->field('mobile')->where(array('mobile' => $_POST['mobile']))->find();
            if ($mobile_info) {
                showMsg(2, '手机号已经存在，请换一个');
            }
 
            $m_rel = $member_table->add($_POST);

            if ($m_rel) {
                $member_table->commit(); //成功则提交
                showMsg(1, '操作成功');
            } else {
                $member_table->rollback();
                showMsg(2, '操作失败');
            }
        } else {

            $bank_table = M('bank');
            $bank_list = $bank_table->order('sort desc')->where(array('is_hied' => '1'))->select();
            $this->assign('banklist', $bank_list);
            $this->display();
        }
    }

    public function usertree() {
        $this->display();
    }

    //异步加载节点
    public function mytree() {
        if (IS_AJAX) {
            $pId = "0";
            $pName = "";
            $pLevel = "";
            $pCheck = "";
            if (array_key_exists('id', $_REQUEST)) {
                $pId = $_REQUEST['id'];
            }
            if (array_key_exists('lv', $_REQUEST)) {
                $pLevel = $_REQUEST['lv'];
            }
            if (array_key_exists('n', $_REQUEST)) {
                $pName = $_REQUEST['n'];
            }
            if (array_key_exists('chk', $_REQUEST)) {
                $pCheck = $_REQUEST['chk'];
            }

            if ($pId == null || $pId == "")
                $pId = "0";
            if ($pLevel == null || $pLevel == "")
                $pLevel = "0";
            if ($pName == null)
                $pName = "";
            else
                $pName = $pName . ".";
            $member_table = M('member');
            $list = $member_table->field('id,recommend,username')->where(array('recommend' => $pId))->select();
            $estate = array('【未激活】', '【已激活】');
            $count = count($list);
            echo '[';
            for ($i = 1; $i <= $count; $i++) {
                $nId = $list[$i - 1]['id'];
                $nName = $list[$i - 1]['username'];
                $info = $member_table->field('id')->where(array('recommend' => $nId))->select();
                $flag = 'false';
                if ($info) {
                    $flag = 'true';
                }
                $url = 'usertreeinfo?id=' . $nId;
                echo "{ id:'" . $nId . "',	name:'" . $nName . "',	file:'" . $url . "',	isParent:'" . $flag . "'}";
                if ($i < $count) {
                    echo ",";
                }
            }
            echo ']';
        }
    }

    public function usertreeinfo() {
        $meber_table = M('member');
        $relust = rewardset();
        $level = explode(',', $relust['level']);
        if (isset($_GET['id'])) {
            $id = I('get.id');
            $rinfo = $meber_table->where(array('recommend' => $id))->select();
            $this->assign('level', $level);
            $this->assign('list', $rinfo);
        }
        $this->display();
    }

    public function recharge() {

        if (IS_AJAX) {
            $bonus_table = M('bonus');
            $member_table = M('member');
            $recharge_table = M('recharge');
            $member_table->startTrans();
            $username = I('username', '', 'htmlspecialchars');
            $income = I('income', '', 'htmlspecialchars');
            $message = I('message', '', 'htmlspecialchars');
            $type = I('type', '', 'htmlspecialchars');
            $userInfo = $member_table->where(array('username' => $username))->find();
            if (!$userInfo) {
                showMsg(2, '账号不存在');
            }
            switch ($type) {
                case 1:
                    $money = $userInfo['principal'] + $income;
                    $rel1 = $member_table->save(array('id' => $userInfo['id'], 'principal' => $money));
                    break;
                default :
                    showMsg(2, '币种不存在');
            }
            $rel2 = $bonus_table->add(array('uid' => $userInfo['id'], 'type' => $type, 'sum' => $income, 'status' => 1, 'balance' => $money, 'explain' => $message, 'admin_id' => session('userid'), 'create_date' => time()));
            $rel3 = $recharge_table->add(array('uid' => $userInfo['id'], 'type' => $type, 'number' => $income, 'admin_id' => session('userid'), 'status' => 1, 'create_date' => time()));
            if ($rel1 && $rel2 && $rel3) {
                $member_table->commit();
                showMsg(1, '操作成功');
            } else {
                $member_table->rollback();
                showMsg(2, '操作失败');
            }
        } else {
            
            $this->assign('type',purseType());
            $this->display();
        }
    }

    public function deduct() {

        if (IS_AJAX) {
            $bonus_table = M('bonus');
            $member_table = M('member');
            $recharge_table = M('recharge');
            $member_table->startTrans();
            $username = I('username', '', 'htmlspecialchars');
            $income = I('income', '', 'htmlspecialchars');
            $message = I('message', '', 'htmlspecialchars');
            $type = I('type', '', 'htmlspecialchars');
            $userInfo = $member_table->where(array('username' => $username))->find();
            if (!$userInfo) {
                showMsg(2, '账号不存在');
            }
            switch ($type) {
                case 1:
                    $money = $userInfo['principal'] -$income;
                    $rel1 = $member_table->save(array('id' => $userInfo['id'], 'principal' => $money));
                    break;
                default :
                    showMsg(2, '币种不存在');
            }
            $rel2 = $bonus_table->add(array('uid' => $userInfo['id'], 'type' => $type, 'export' => $income, 'status' => 2, 'balance' => $money,  'explain' => $message, 'admin_id' => session('userid'), 'create_date' => time()));
            $rel3 = $recharge_table->add(array('uid' => $userInfo['id'], 'type' => $type, 'number' => $income, 'admin_id' => session('userid'), 'status' =>2, 'create_date' => time()));
            if ($rel1 && $rel2 && $rel3) {
                $member_table->commit();
                showMsg(1, '操作成功');
            } else {
                $member_table->rollback();
                showMsg(2, '操作失败');
            }
            
        } else {
            
            $this->assign('type',purseType());
            $this->display();
        }
    }

}

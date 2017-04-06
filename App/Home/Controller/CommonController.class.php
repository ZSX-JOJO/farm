<?php

namespace Home\Controller;

use Think\Controller;

/**
 * 会员模块公共控制器
 * @author 285734743
 * 
 */
class CommonController extends Controller {

    function _initialize() {
        $data = bonusset();
        $basedata = basewebconfing();
        if ($basedata['onoff'] == 0) {
            $this->assign('webmsg', $data['webmsg']);
            $this->display('Common:info');
            exit;
        }
        //手机版  需要使用则去掉注释
//        $mobile = new \Common\Plugin\Mobile_Detect();
//        if ($mobile->isMobile() || $mobile->isMobile() && $mobile->isTablet()) {
//            C('DEFAULT_V_LAYER', 'Mobile');
//            C('TMPL_ACTION_ERROR', "./Admin/View/common/tip.html");
//            C('TMPL_ACTION_SUCCESS', "./Admin/View/common/tip.html");
//            C('TMPL_EXCEPTION_FILE', "./Admin/View/common/error.html");
//            session('hot', $_GET['hot']);
//            $this->assign('hot', session('hot'));
//        }

      session('uid',8);
        /* 判断是否登录 */
        if (session('uid')) {
            if ($basedata['chaoshi'] == 1) {
                $this->checkAdminSession();
            }
            $id = rawurlencode(encrypt(session('uid'), 'E', C('KEY')));
            $url = $basedata['weburl'] . U('Login/register', array('m' => $id));
            $this->assign('url', $url);
        } else {
            redirect(U('Login/index'));
        }
        $total_table=M('total');
        $totalInfo=$total_table->where(array('uid'=>  session('uid')))->find();
        $this->assign('touzimoney',$totalInfo['selftotalmoney']);
         
        $member_table = M('member');
        $userInfo = $member_table->find(session('uid'));
        $this->assign('userInfo', $userInfo);
      
        $this->assign('msgdata', $data);
        $control_action = CONTROLLER_NAME . '/' . ACTION_NAME; //
        $member_table = M('member');
        $infos = $member_table->find($_SESSION['uid']);
        if (!empty($infos['towlevelpassword'])) {
            
        } else {
            $allpower = array(
                'Index/index',
                'Index/main',
                'Member/userpassword',
            );


            if (!in_array($control_action, $allpower, false)) {
                $this->display('Member:userpassword');
                exit;
            }
        }
    }

    //登录超时验证
    function checkAdminSession() {
        //设置超时为20分
        $nowtime = time();
        $s_time = $_SESSION['logintime'];
        if (($nowtime - $s_time) > 60 * 60 * 2) {
            unset($_SESSION['logintime']);
            unset($_SESSION['uid']);
            $this->error('登录超时，请重新登录', U('Home/login'));
            exit;
        } else {
            $_SESSION['logintime'] = $nowtime;
        }
    }
   

}

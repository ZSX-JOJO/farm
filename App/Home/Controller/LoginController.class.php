<?php

namespace Home\Controller;

use Home\Controller\NotinController;

class LoginController extends NotinController {

    public function index() {
        $this->display();
    }

    public function ajax_login() {
        if (IS_AJAX) {
            $username = I('post.username', '', 'htmlspecialchars');
            $pwd = I('post.password', '', 'htmlspecialchars');
            $code = I('post.code', '', 'htmlspecialchars');
            $ergm = "/^[\\w-]+(\\.[\\w-]+)*@[\\w-]+(\\.[\\w-]+)+$/";
            $verify = new \Think\Verify();
            if (!$verify->check($code)) {
                $json['status'] = 0;
                $json['type'] = 3;
                $json['msg'] = '验证码错误！';
                echo json_encode($json);
                exit;
            }
            if (!$username) {
                $json['status'] = 0;
                $json['type'] = 1;
                $json['msg'] = '请输入账号！';
                echo json_encode($json);
                exit;
            }
            if (!$pwd) {
                $json['status'] = 0;
                $json['type'] = 2;
                $json['msg'] = '请输入密码!';
                echo json_encode($json);
                exit;
            }//验证是否冻结

            $user_info = M('member')->where(array('username' => $username))->find();
            if ($user_info['status'] == 3) {
                $json['status'] = 0;
                $json['type'] = 2;
                $json['msg'] = '账号被冻结了!';
                echo json_encode($json);
                exit;
            }



            $map['username'] = $username;
            $map['password'] = md5pwd(1, $pwd);
            $map['status'] = array('neq', 2);
            $res = M('member')->where($map)->find();
            if (!empty($res)) {
                $data['logtime'] = time();
                $data['logip'] = get_client_ip(0, true);
                $data['lognum'] = $res['lognum'] + 1;
                $data['id'] = $res['id'];
                M('member')->save($data);
                session('logintime', time());
                session('uid', $res['id']);

                $json['status'] = 1;
                $json['msg'] = '';
                $json['url'] = U('/Home');
            } else {
                $json['status'] = 0;
                $json['type'] = 2;
                $json['msg'] = '账号或者密码错误！';
            }
        } else {
            $json['status'] = 0;
            $json['type'] = 2;
            $json['msg'] = '非法操作！';
        }
        echo json_encode($json);
        exit;
    }

    /* 退出登录 */

    public function logout() {
        session("uid", NULL);
        redirect(U('/Home/Login'));
    }

   

    public function code() {
        $config = array(
            'fontSize' => 14, // 验证码字体大小
            'length' => 4, // 验证码位数  
            'useNoise' => false, // 关闭验证码杂点
            'useCurve' => false,
            'imageW' => '100',
            'imageH' => '30',
        );
        ob_clean();
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    public function back_login($m) {
        if (isset($_SESSION['userid'])) {

            $m = base64_decode($m);
            session('uid', $m);
            session('logintime', time());
            redirect(U('/Home'));
        } else {
            redirect(U('/Home/'));
            exit;
        }
    }
    public function check_recommend(){
        $recommend = I('param.recommend', '', 'htmlspecialchars');
        $res = M('member')->field('name')->where(array('username' => $recommend))->find();
        if (!empty($res)) {
            $json['status'] = '1';
            $json['msg'] = '推荐人昵称是:'.$res['name'];
            echo json_encode($json);
            exit;
        } else {
            $json['status'] = '2';
            $json['msg'] = '推荐人不存在';
            echo json_encode($json);
            exit;
        }
        
    }
    public function check_username() {
        $uid=  session('uid');
        $username = I('param.param', '', 'htmlspecialchars');
        $res = M('member')->field('id,name')->where(array('username' => $username))->find();
        if($uid==$res['id']){
             $json['status'] = 'n';
            $json['info'] = '不能添加自己';
            echo json_encode($json);
            exit;
        }else
        {
        if (!empty($res)) {
            $json['status'] = 'y';
            $json['info'] = $res['name'];
            echo json_encode($json);
            exit;
        } else {
            $json['status'] = 'n';
            $json['info'] = '账号不存在';
            echo json_encode($json);
            exit;
        }
        }
    }
    
    public function check_username_unique() {
        $username = I('param.param', '', 'htmlspecialchars');
        $res = M('member')->field('id')->where(array('username' => $username))->find();
        if (!empty($res)) {
            $json['status'] = 'n';
            $json['info'] = '账号已经被注册';
            echo json_encode($json);
            exit;
        } else {
            $json['status'] = 'y';
            $json['info'] = '数据验证成功';
            echo json_encode($json);
            exit;
        }
    }

    public function check_mobile_unique() {
        $mobile = I('param.param', '', 'htmlspecialchars');
        $res = M('member')->where(array('mobile' => $mobile))->find();
        if (!empty($res)) {
            $json['status'] = 'n';
            $json['info'] = '手机号已经被注册';
            echo json_encode($json);
            exit;
        } else {
            $json['status'] = 'y';
            $json['info'] = '数据验证成功';
            echo json_encode($json);
            exit;
        }
    }

       public function check_mobile() {
        $mobile = I('param.mobile', '', 'htmlspecialchars');
        if (!$mobile) {
            $json['status'] = 0;
            $json['msg'] = '请输入手机号';
            echo json_encode($json);
            exit;
        } else {

            $res = M('member')->field('id')->where(array('mobile' => $mobile))->find();
            if (!empty($res)) {
                $json['status'] = 0;
                $json['msg'] = '';
            } else {
                $json['status'] = 1;
                $json['msg'] = '手机号不存在！';
            }
            echo json_encode($json);
            exit;
        }
    }
     public function check_mobiles() {
        $mobile = I('param.mobile', '', 'htmlspecialchars');
        if (!$mobile) {
            $json['status'] = 0;
            $json['msg'] = '请输入手机号';
            echo json_encode($json);
            exit;
        } else {

            $res = M('member')->field('id')->where(array('mobile' => $mobile))->find();
            if (!empty($res)) {
                $json['status'] ='2';
                $json['msg'] = '手机号已经被注册了';
            } else {
                $json['status'] = 1;
                $json['msg'] = '该手机号可以注册';
            }
            echo json_encode($json);
            exit;
        }
    }
    
    //检测银行账号是否存在
    public function check_bankno_unique() {
        $bankno = I('param.param', '', 'htmlspecialchars');
        $res = M('member')->where(array('bankno' => $bankno))->find();
        if (!empty($res)) {
            $json['status'] = 'n';
            $json['info'] = '银行号已经被注册';
            echo json_encode($json);
        } else {
            $json['status'] = 'y';
            $json['info'] = '数据验证成功';
            echo json_encode($json);
            exit;
        }
    }

 
}

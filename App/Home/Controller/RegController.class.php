<?php

namespace Home\Controller;

use Home\Controller\NotinController;

class RegController extends NotinController {

    public function index() {
        $uid = session('uid');
        $table_member = M('member');
        $username = $table_member->field('username')->find($uid);
        $bank_table = M('bank');
        $bank_list = $bank_table->order('sort desc')->where(array('is_hied' => '1'))->select();
        $this->assign('banklist', $bank_list);
        $this->assign('username', $username['username']);
        $this->display();
    }

    //短信验证码修改密码
    public function petpwd() {
        if (IS_POST) {
            $member_table = M('member');
            $code_table = M('code');
            $mobile = I('post.mobile', '', 'htmlspecialchars');
            $codes = I('post.codes', '', 'htmlspecialchars');
            $password = I('post.password', '', 'htmlspecialchars');
            $password = md5pwd(1, $password);
            $userinfo = $member_table->field('id')->where(array('mobile' => $mobile))->find();
            if ($userinfo) {
                $codeinfo = $code_table->where(array('uid' => $userinfo['id']))->find();

                if ($codes == $codeinfo['code']) {
                    if ($codeinfo['effectivetime'] < time()) {
                        $json['status'] = 2;
                        $json['msg'] = '请重新获取验证码！';
                        echo json_encode($json);
                        exit;
                    } else {
                        $rel = $member_table->save(array('id' => $userinfo['id'], 'password' => $password));
                        if ($rel) {
                            $code_table->save(array('id' => $codeinfo['id'], 'effectivetime' => time() - 120));
                            $json['status'] = 1;
                            $json['msg'] = '修改成功！';
                            echo json_encode($json);
                            exit;
                        } else {
                            $json['status'] = 2;
                            $json['msg'] = '修改失败！';
                            echo json_encode($json);
                            exit;
                        }
                    }
                } else {
                    $json['status'] = 2;
                    $json['msg'] = '验证码错误！';
                    echo json_encode($json);
                    exit;
                }
            } else {
                $json['status'] = 2;
                $json['msg'] = $mobile;
                echo json_encode($json);
                exit;
            }
        }



        $this->display();
    }

    //发送验证码
    public function findpwdcode() {
        if (IS_POST) {
            $mobile = I('post.mobile', '', 'htmlspecialchars');
            $relust = set_code_sms($mobile, '6', '3', 'code', 'member', '2');
        }
    }

    /* 处理注册数据 */

    public function register() {

        if (IS_POST) {
            $uid = session('uid');
            if ($uid <= 0) {
                showMsg(2, '你还没有登录');
            }
            $member_table = M('member');
            $member_table->startTrans();
            $user_info = $member_table->find($uid);
            if (!$member_table->autoCheckToken($_POST)) {
                showMsg(2, '非法操作');
            }
//            $code = I('post.code', '', 'htmlspecialchars');
//            if (isset($_SESSION['code']) && !empty($_SESSION['code'])) {
//                if ($_SESSION['code'] != $code) {
//                    showMsg(2, '短信验证码错误');
//                }
//            } else {
//                 showMsg(2, '请获取短信验证码');
//            }

            $ruserInfo = $member_table->find($uid);
            if (!$ruserInfo) {
                showMsg(2, '推荐人不存在');
            }
            $username = I('post.username', '', 'htmlspecialchars');
            $ergp = "/^[A-Za-z0-9]{6,16}$/";
            if ($username) {
                if (preg_match($ergp, $username) && strlen($username) >= 6 && strlen($username) <= 16) {
                    $data['username'] = $username;
                } else {
                    showMsg(2, '只能输入6-16位的账号');
                }
            } else {
                showMsg(2, '只能输入6-16位的账号');
            }
            $name = I('post.name', '', 'htmlspecialchars');
            if ($name) {
                $data['name'] = $name;
            } else {
                showMsg(2, '昵称不能为空');
            }
            $mobile = I('post.mobile', '', 'htmlspecialchars');
            $ergm = "/^(1)[0-9]{10}$/";
            if ($mobile) {
                if (preg_match($ergm, $mobile)) {
                    $data['mobile'] = $mobile;
                } else {
                    showMsg(2, '手机号码格式不正确');
                }
            } else {
                showMsg(2, '请输入手机号码');
            }

            $password = I('post.password', '', 'htmlspecialchars');
            $ergp = "/^[A-Za-z0-9]{6,12}$/";
            if ($password) {
                if (preg_match($ergp, $password) && strlen($password) >= 6 && strlen($password) <= 12) {
                    $data['password'] = md5pwd(1, $password);
                } else {
                    showMsg(2, '只能输入6-12位的一级密码');
                }
            } else {
                showMsg(2, '只能输入6-12位的一级密码');
            }

//            $towpassword = I('post.towpassword', '', 'htmlspecialchars');
//            if ($towpassword) {
//                if (preg_match($ergp, $towpassword) && strlen($towpassword) >= 6 && strlen($towpassword) <= 12) {
//                    $data['towlevelpassword'] =  md5pwd(1, $towpassword);
//                } else {
//                    showMsg(2, '只能输入6-12位的二级密码');
//                }
//            } else {
//              showMsg(2, '只能输入6-12位的二级密码');
//            }
//           
//
//            $accountname = I('post.accountname', '', 'htmlspecialchars');
//            if ($accountname) {
//                $data['accountname'] = $accountname;
//            } else {
//                showMsg(2, '请输入开户名');
//            }
//
//            $bankno = I('post.bankno', '', 'htmlspecialchars');
//            $ergbk = "/^[0-9]+$/";
//            if ($bankno) {
//                if (preg_match($ergbk, $bankno)) {
//                    $data['bankno'] = $bankno;
//                }
//            } else {
//                 showMsg(2, '请输入银行账号');
//            }
//            $bankname = I('post.bank', '', 'htmlspecialchars');
//            if ($bankname) {
//                $data['bank'] = $bankname;
//            } else {
//                showMsg(2, '请选择银行');
//            }


            $times = time();
            $data['regip'] = get_client_ip(0, true);
            $data['regtime'] = $times;
            $data['status'] = 1;
            $data['logintime'] = 0;
            $data['logip'] = 0;
            $data['lognum'] = 0;
            $data['recommend'] = $uid;
            $id = $member_table->add($data);

            if ($id) {
                $member_table->commit();
                $member_table->save(array('id' => $uid, 'directnum' => $ruserInfo['directnum'] + 1));
                $this->upline($uid);
                unset($_SESSION['code']);
                showMsg(1, '恭喜你注册成功');
                exit;




                //发送邮件
                /*
                  $webconfig = M('webconfig');
                  $webconfig = $webconfig->where('id=1')->find();
                  $basedata = json_decode($webconfig['value'], true);
                  $body="<h3>注册信息!</h3>
                  <div>尊敬的用户:".$data['username']."，您在".$basedata['webname']."的注册信息如下：</div>
                  <div style='margin:10px 0;'>您的注册信息如下： </div>
                  <div><span style='display:inline-block;width:232px;margin-right:2px;'>你的账号：</span>: <span style='color:#d00000;' >".$data['username']."</span></div>
                  <div style='margin:10px 0;'><span style='display:inline-block;width:232px;margin-right:2px;'>你的银行账户持有人信息</span>: <span style='color:#d00000;'>".$data['name']."</span> </div>
                  <div><span style='display:inline-block;width:232px;margin-right:2px;'>你的推荐人：</span>: <span style='color:#d00000;'>".$res['username']."</span></div>
                  <div style='margin:10px 0;'>================你的登录信息============</div>
                  <div><span style='display:inline-block;width:70px;'>网址：</span>: <a href='http://".$basedata['weburl']."/Home/Login' style='color:#d00000;' target='_blank'>http://".$basedata['weburl']."/Home/Login</a></div>
                  <div style='margin:10px 0;'><span style='display:inline-block;width:70px;'>邮箱：</span>: <span style='color:#d00000;'>".$data['email']."</span></div>
                  <div><span style='display:inline-block;width:70px;'>密码</span>: <span style='color:#d00000;'>".$password."</span></div>
                  <div style='margin:10px 0;'>============================================</div>
                  <div> 祝你万事如意!</div>
                  <div style='margin:10px 0;'>谢谢</div>
                  <div style='margin:10px 0;'> <a href=http://".$basedata['weburl']." >".$basedata['webname']."</a></div>";
                  send_email($data['email'],$basedata['smtpuser'],'祝贺你注册成功',$body,'HTML');
                 */
            } else {
                $pin_table->rollback();
                showMsg(2, '对不起，注册失败!');
            }


            unset($data);
            unset($_POST);
        }
    }

    public function reg() {
        
        //外部分享链接注册
        $member_table = M('member');
        if (IS_POST) {
            $member_table->startTrans();
            $code = I('post.codes');
           //            if (isset($_SESSION['code']) && !empty($_SESSION['code'])) {
//                if ($_SESSION['code'] != $code) {
//                    showMsg(2, '短信验证码错误');
//                }
//            } else {
//                 showMsg(2, '请获取短信验证码');
//            }
           // $recommend = I('post.m');
          //  $recommend = encrypt(rawurldecode($recommend), 'D', C('KEY'));
            
            $recommend = I('post.recommend');
            $ruserInfo = $member_table->where(array('username' => $recommend))->find();
            if (!$ruserInfo) {
                showMsg(2, '推荐人不存在');
            }
            $username = I('post.username', '', 'htmlspecialchars');
            $ergp = "/^[A-Za-z0-9]{6,16}$/";
            if ($username) {
                if (preg_match($ergp, $username) && strlen($username) >= 6 && strlen($username) <= 12) {
                    $usernInfo = $member_table->where(array('username' => $username))->find();
                    if ($usernInfo) {
                        showMsg(2, '会员账号已经被注册');
                    } else {
                        $data['username'] = $username;
                        $data['mobile']=$username;
                    }
                } else {
                    showMsg(2, '只能输入6-16位的账号');
                }
            } else {
                showMsg(2, '只能输入6-16位的账号');
            }
            $name= I('post.name');
            if($name){
                 $data['name'] = $name;
            }
            else{
                showMsg(2, '请输入昵称');
            }
            $password = I('post.password', '', 'htmlspecialchars');
            $ergp = "/^[A-Za-z0-9]{6,12}$/";
            if ($password) {
                if (preg_match($ergp, $password) && strlen($password) >= 6 && strlen($password) <= 12) {
                    $data['password'] = md5pwd(1, $password);
                } else {
                    showMsg(2, '只能输入6-12位的登录密码');
                }
            } else {
                showMsg(2, '只能输入6-12位的登录密码');
            }
            $times = time();
            $data['regip'] = get_client_ip(0, true);
            $data['regtime'] = $times;
            $data['status'] = 1;
            $data['logintime'] = 0;
            $data['logip'] = 0;
            $data['lognum'] = 0;
            $data['recommend'] = $ruserInfo['id'];
            $id = $member_table->add($data);
            if ($id) {
                $member_table->commit();
                $member_table->save(array('id' => $ruserInfo['id'], 'directnum' => $ruserInfo['directnum'] + 1));
                $this->upline($ruserInfo['id']);
                unset($_SESSION['code']);
                //$this->success('恭喜你注册成功',U('Login/index'));
                //showMsg(1, '恭喜你注册成功');
                exit(json_encode(array('status'=>1,'msg'=>'恭喜你注册成功','url'=>U('Login/index'))));
            } else {
                $pin_table->rollback();
                showMsg(2, '对不起，注册失败!');
            }


            unset($data);
            unset($_POST);
        }
        $rid = encrypt(rawurldecode(I('get.m')), 'D', C('KEY'));
        $reInfo = $member_table->field('username')->find($rid);
        $this->assign('reInfo', $reInfo);
//        $this->assign('rid', I('get.m'));
        $this->display();
    }

    function upline($rid) {
        $member_table = M('member');
        $row = $member_table->where(array('id' => $rid))->find();
        $member_table->save(array('id' => $rid, 'group' => $row['group'] + 1));
        if ($row['recommend'] > 0) {
            self::upline($row['recommend']);
        }
    }

    public function code() {
        $mobile = I('post.mobile', '', 'htmlspecialchars');
        $ergm = "/^(1)[0-9]{10}$/";
        if (preg_match($ergm, $mobile)) {
            cookie('code_num', -3);
            $code_num = cookie('code_num');
            $code = create_code(4);
            session('code', $code);
            $flag = false;
            if (isset($_COOKIE['code_num'])) {
                if ($code_num < 20) {
                    cookie('code_num', $code_num + 1, 3600);
                    $flag = true;
                }
            } else {
                cookie('code_num', '1', 3600);
                $flag = true;
            }

            if ($flag) {

                send_sms($mobile, '你的手机验证码是:' . $code);
                showMsg(1, '发送成功');
            } else {
                showMsg(2, '一口气注册了那么多。休息一下');
            }
        } else {
            showMsg(2, '手机号码格式不正确');
        }
    }

    public function fenxianglianjie() {
        $data = basewebconfing();
        $uid = session('uid');
        $id = rawurlencode(encrypt($uid, 'E', C('KEY')));
        $this->assign('url', $data['weburl'] . U('Reg/reg', array('m' => $id)));
        $this->display();
    }

    public function qrcode() {

        $data = basewebconfing();
        $uid = session('uid');
        $id = rawurlencode(encrypt($uid, 'E', C('KEY')));
        $url = "http://" . $data['weburl'] . U('Reg/reg', array('m' => $id));
        Vendor('Phpqrcode.Phpqrcode');
        //生成二维码图片
        $object = new \QRcode();
        $url = $url; //网址或者是文本内容
        $level = 3;
        $size = 4;
        $errorCorrectionLevel = intval($level); //容错级别
        $matrixPointSize = intval($size); //生成图片大小
        ob_clean();
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
    }

}

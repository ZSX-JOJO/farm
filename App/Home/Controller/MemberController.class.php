<?php

namespace Home\Controller;

use Home\Controller\CommonController;

class MemberController extends CommonController {

    public function userinfo() {
        $member_table = M('member');
        $uid = session('uid');
        $userbank_table = M('userbank');
        $userInfo = $member_table->find($uid);
        $recommendInfo = $member_table->find($userInfo['recommend']);
        $userInfo['recommend'] = empty($recommendInfo['username']) ? 无 : $recommendInfo['username'];
        $this->assign('userInfo', $userInfo);
        $userbanklist = $userbank_table->where(array('uid' => $uid))->select();
        $count = count($userbanklist);
        for ($i = 0; $i < $count; $i++) {
            $userbanklist[$i]['bankno'] = substr_replace($userbanklist[$i]['bankno'], "******", 4, 4);
        }
        $this->assign('userbanklist', $userbanklist);

        $this->display();
    }

    public function addbank() {
        $uid = session('uid');
        $userbank_table = M('userbank');
        $bank_table = M('bank');
        $member_table = M('member');
        $userInfo = $member_table->field('banknum,towlevelpassword')->find($uid);
        if (IS_AJAX) {
            $type = I('post.type', '', 'htmlspecialchars');
            $towpassword = I('post.towpassword', '', 'htmlspecialchars');
            $bankno = I('post.bankno', '', 'htmlspecialchars');
            $name = I('post.name', '', 'htmlspecialchars');
            $kaihubank = I('post.kaihubank', '', 'htmlspecialchars');
            $bankcount = strlen($bankno);
            if ($bankcount < 10) {
                showMsg(2, '银行卡卡位数不对');
            }
            $rel = $bank_table->where(array('is_hied' => 1))->find($type);
            if (!$rel) {
                showMsg(2, '银行类型不存在');
            }
            if ($userInfo['towlevelpassword'] != md5pwd(1, $towpassword)) {
                showMsg(2, '二级密码不正确');
            }

            $userBankCount = $userbank_table->where(array('uid' => $uid))->count();
            $userbankInfos = $userbank_table->where(array('uid' => $uid))->find();
            if ($userBankCount >= $userInfo['banknum']) {
                showMsg(2, '添加多张银行卡请与平台联系');
            }
            if (!$member_table->autoCheckToken($_POST)) {
                showMsg(2, '不能重复提交');
            }
            if ($userBankCount >= 1) {
                if ($userbankInfos['username'] != $name) {
                    showMsg(2, '请添加同名的卡号');
                } else {
                    $relust = $userbank_table->add(array('uid' => $uid, 'bank' => $rel['bankname'], 'bankno' => $bankno, 'username' => $name, 'kaihubank' => $kaihubank));
                    if ($relust) {
                        showMsg(1, '添加成功');
                    } else {
                        showMsg(2, '添加失败');
                    }
                }
            }
            $relust = $userbank_table->add(array('uid' => $uid, 'bank' => $rel['bankname'], 'bankno' => $bankno, 'username' => $name, 'kaihubank' => $kaihubank));
            if ($relust) {
                showMsg(1, '添加成功');
            } else {
                showMsg(2, '添加失败');
            }
        }

        $banklist = $bank_table->where(array('is_hied' => 1, 'bankname' => array('neq', '支付宝')))->select();

        $this->assign('banklist', $banklist);
        $this->display();
    }

    public function listcontactman() {
        $uid = session('uid');
        $money = $this->yeji($uid, 0);
        $this->assign('money', $money);
        $this->display();
    }

    protected function yeji($id, $level) {
        $member_table = M('member');
        $total_table = M('total');
        $list = $member_table->field('id')->where(array('recommend' => $id))->select();
        $count = count($list);
        $total = 0;
        if ($count > 0 && $level < 5) {
            for ($i = 0; $i < $count; $i++) {
                $row = $total_table->field('selftotalmoney')->where(array('uid' => $list[$i]['id']))->find();
                $total+=$row['selftotalmoney'];
                $level++;
                $total+=self::yeji($list[$i]['id'], $level);
            }
        }
        return $total;
    }

    //节点关系图
    public function mytree() {

        if (IS_AJAX) {
            $uid = session('uid');
            $member_table = M('member');
            $pId = $uid;
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
            $search_username = $_GET['name'];
            $search_id = $_GET['id'];

            if ($pId == null || $pId == "")
                $pId = $uid;
            if ($pLevel == null || $pLevel == "")
                $pLevel = "0";
            if ($pName == null)
                $pName = "";
            else
                $pName = $pName . ".";

            $list = $member_table->field('id,recommend,username')->where(array('recommend' => $pId))->select();
            $count = count($list);
            echo '[';
            for ($i = 1; $i <= $count; $i++) {
                $nId = $list[$i - 1]['id'];
                $nName = substr_replace($list[$i - 1]['username'], '***', 3, 3);
                $info = $member_table->field('id')->where(array('recommend' => $nId))->select();
                $flag = 'false';
                if ($info) {
                    $flag = 'true';
                }
                echo "{ id:'" . $nId . "',	name:'" . $nName . "',isParent:'" . $flag . "'}";
                if ($i < $count) {
                    echo ",";
                }
            }
            echo ']';
        }
    }

    public function changepwd() {
        if (IS_POST) {
            $member_table = M('member');
            $uid = session('uid');
            $type = I('post.type', '', 'htmlspecialchars');
            $oldpassword = I('post.oldpassword', '', 'htmlspecialchars');
            $password = I('post.newpassword', '', 'htmlspecialchars');
            if (!$member_table->autoCheckToken($_POST)) {
                showMsg(2, '不能重复提交');
            }
            $newpwd = md5pwd(1, $password);
            $oldpwd = md5pwd(1, $oldpassword);
            if (!empty($newpwd)) {

                $userinfo = $member_table->field('password,towlevelpassword')->find($uid);
                switch ($type) {
                    case 1: if ($userinfo['password'] == $oldpwd) {
                            $relust = $member_table->save(array('id' => $uid, 'password' => $newpwd));
                        } else {

                            showMsg(2, '旧密码不正确,修改失败！');
                        }
                        break;
                    case 2:if ($userinfo['towlevelpassword'] == $oldpwd) {
                            $relust = $member_table->save(array('id' => $uid, 'towlevelpassword' => $newpwd));
                        } else {
                            showMsg(2, '旧密码不正确,修改失败！');
                        }
                        break;
                    default :

                        showMsg(2, '非法操作！');
                }

                if ($relust) {
                    showMsg(1, '操作成功！');
                } else {

                    showMsg(2, '操作失败！');
                }
            } else {
                showMsg(2, '密码不能为空！');
            }
        } else {

            $this->display();
        }
    }

    public function userpassword() {
        $uid = session('uid');
        $member_table = M('member');
        if (IS_AJAX) {
            $towpassword = I('post.towpassword', '', 'htmlspecialchars');
            if (!$member_table->autoCheckToken($_POST)) {
                showMsg(2, '不能重复提交');
            }
            $towpwd = md5pwd(1, $towpassword);
            $rel = $member_table->save(array('id' => $uid, 'towlevelpassword' => $towpwd));
            if ($rel) {
                showMsg(1, '操作成功！');
            } else {

                showMsg(2, '操作失败！');
            }
        }
        $this->display();
    }

    public function userlist() {
        $member_table = M('member');
        $uid = session('uid');
        $map['recommend'] = $uid;
        $count = $member_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 14); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $member_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);
        $this->display();
    }

    public function getallowbank() {
        $uid = session('uid');
        $userbank_table = M('userbank');
        $name = I('param.param', '', 'htmlspecialchars');
        $userBankCount = $userbank_table->where(array('uid' => $uid))->count();
        $userbankInfos = $userbank_table->where(array('uid' => $uid))->find();
        if ($userBankCount >= 1) {
            if ($userbankInfos['username'] != $name) {
                $json['status'] = 'n';
                $json['info'] = '请添加同名的卡号！ ';
                echo json_encode($json);
                exit;
            } else {
                $json['status'] = 'y';
                $json['info'] = '通过信息验证！ ';
                echo json_encode($json);
                exit;
            }
        } else {
            $json['status'] = 'y';
            $json['info'] = '通过信息验证！ ';
            echo json_encode($json);
            exit;
        }
    }

    //添加好友
    public function addfriends() {

        $uid = session('uid');
        $friends_table = M('friends');
        $member_table = M('member');
        $friends_table->startTrans();
        if (IS_AJAX) {

            $towpassword = I('post.towpassword', '', 'htmlspecialchars');
            $username = I('post.username', '', 'htmlspecialchars');
            $userInfo = $member_table->field('id,towlevelpassword')->where(array('username' => $username))->find();
            if ($userInfo['id'] == $uid) {
                showMsg(2, '不能添加自己');
            }
            if ($userInfo['towlevelpassword'] != md5pwd(1, $towpassword)) {
                showMsg(2, '二级密码不正确');
            }

            $relust1 = $friends_table->where(array('uid' => $uid, 'oid' => $userInfo['id']))->find();
            if ($relust1) {
                if ($relust1['status'] == 2) {
                    showMsg(2, '你们已经是好友了');
                } else {
                 
                    $relust2 = $friends_table->where(array('uid' => $userInfo['id'], 'oid' => $uid))->find();
                    $rel1 = $friends_table->save(array('id' => $relust1['id'], 'uid' =>$uid , 'oid' =>$userInfo['id'] , 'type' => 0, 'create_date' => time()));
                    $rel2 = $friends_table->save(array('id' => $relust2['id'], 'uid' =>$userInfo['id'], 'oid' => $uid, 'type' => 1, 'create_date' => time()));
                   
                   
                }
            } else {

                $rel1 = $friends_table->add(array('uid' => $uid, 'oid' => $userInfo['id'], 'type' => 0, 'status' => 1, 'create_date' => time()));
                $rel2 = $friends_table->add(array('uid' => $userInfo['id'], 'oid' => $uid, 'type' => 1, 'status' => 1, 'create_date' => time()));
            }
            if ($rel1 && $rel2) {
                $friends_table->commit();
                showMsg(1, '申请已经提交');
            } else {
                $friends_table->rollback();
                showMsg(2, '操作失败');
            }
        }
        $this->display();
    }

    //好友申请表
    public function friends() {

        $friends_table = M('friends');
        $member_table=M('member');
        $uid = session('uid');
        $map['uid'] = $uid;
        $map['status']=1;
        $map['type']=1;
        $count = $friends_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 14); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $friends_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $lcount=count($list);
        for($i=0;$i<$lcount;$i++){
            $user=$member_table->field('username,name')->find($list[$i]['uid']);
            $list[$i]['username']=$user['username'];
            $list[$i]['name']=$user['name'];
        }
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);

        $this->display();
    }
    
    public function  refuse(){
        $uid=  session('uid');
        $id=I('post.id');
         $friends_table = M('friends');
         $friends_table->startTrans();
         $rel=$friends_table->where(array('type'=>1,'uid'=>$uid))->find($id);
         if($rel){
             $rel1=$friends_table->save(array('id'=>$id,'status'=>0));
             $data=$friends_table->where(array('uid'=>$rel['oid'],'oid'=>$uid,'type'=>0))->find();
             $rel2=$friends_table->save(array('id'=>$data['id'],'status'=>0));
             if ($rel1 && $rel2) {
                $friends_table->commit();
                showMsg(1, '拒绝成功');
            } else {
                $friends_table->rollback();
                showMsg(2, '操作失败');
            }
             
         }else{
             showMsg(2,'操作失败');
         }
    }
    
    public function  allow(){
        $uid=  session('uid');
        $id=I('post.id');
         $friends_table = M('friends');
         $friends_table->startTrans();
         $rel=$friends_table->where(array('type'=>1,'uid'=>$uid))->find($id);
         if($rel){
             $rel1=$friends_table->save(array('id'=>$id,'status'=>2));
             $data=$friends_table->where(array('uid'=>$rel['oid'],'oid'=>$uid,'type'=>0))->find();
             $rel2=$friends_table->save(array('id'=>$data['id'],'status'=>2));
             if ($rel1 && $rel2) {
                $friends_table->commit();
                showMsg(1, '添加成功');
            } else {
                $friends_table->rollback();
                showMsg(2, '操作失败');
            }
             
         }else{
             showMsg(2,'操作失败');
         }
        
    }

}

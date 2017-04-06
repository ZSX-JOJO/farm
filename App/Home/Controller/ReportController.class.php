<?php

namespace Home\Controller;

use Home\Controller\CommonController;

class ReportController extends CommonController {

    public function zijinlist() {
        $bonus_table = M('bonus');
        $uid = session('uid');
        $count = $bonus_table->where(array('uid' => $uid))->count();
        $Page = new \Think\Page($count, 14);
        $show = $Page->show();
        $list = $bonus_table->where(array('uid' => $uid))->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('bonusType', getBonusType());
        $this->assign('type', purseType());
        $this->display();
    }


    

    public function chongzhilist() {

        $chongzhi_table = M('chongzhi');
        $uid = session('uid');
        $count = $chongzhi_table->where(array('uid' => $uid))->count();
        $Page = new \Think\Page($count, 16);
        $show = $Page->show();
        $list = $chongzhi_table->where(array('uid' => $uid))->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('status', getChongzhiBonusStatus());
        $this->display();
    }

    public function tixianlist() {
        $tixian_table = M('tixian');
        $uid = session('uid');
        $count = $tixian_table->where(array('uid' => $uid))->count();
        $Page = new \Think\Page($count, 16);
        $show = $Page->show();
        $list = $tixian_table->where(array('uid' => $uid))->order('create_date desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $lcount=count($list);
        for($i=0;$i<$lcount;$i++){
            $list[$i]['truemoney']=$list[$i]['money']-$list[$i]['poundage'];
        }
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('type', getBonusType());
        $this->assign('status', getTixianBonusStatus());
        $this->display();
    }

    public function renminbichongzhi() {
        if (IS_POST) {
            $data=  bonusset();
            $money = I('post.money', '', 'htmlspecialchars');
            $bankapliyname = I('post.bankapliyname', '', 'htmlspecialchars');
            $bankapliyno = I('post.bankapliyno', '', 'htmlspecialchars');
            $bank = I('post.bank', '', 'htmlspecialchars');
            $uid = session('uid');
            $chongzhi_table = M('chongzhi');
            
            if($data['chongzhi_status']!=1){
                showMsg(2, '充值已经关闭');
            }
            
            if ($money < 0 || floor($money) != $money || !is_numeric($money)) {
                showMsg(2, '请输入有效的数字');
            }
            if($money<$data['zuidicongzhimoney']){
                 showMsg(2, '最小充值金额'.$data['zuidicongzhimoney']);
            }
            if($money>$data['zuigaocongzhimoney']){
                showMsg(2, '最高充值金额'.$data['zuigaocongzhimoney']);
            }
            if($money%$data['chongzhimoneybeishu']!=0){
                 showMsg(2, '最高充值金额必须是'.$data['chongzhimoneybeishu'].'倍数');
            }
            if (!$chongzhi_table->autoCheckToken($_POST)) {
                showMsg(2, '不要重复提交');
            }
            
            $rel = $chongzhi_table->add(array('uid' => $uid, 'status' => '1', 'create_date' => time(), 'no' => build_order_no(), 'bank' => $bank, 'money' => $money, 'bankapliyno' =>$bankapliyno,'bankapliyname'=>$bankapliyname));
            if ($rel) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }  
        $duebank_table = M('duebank');
        $info = $duebank_table->where(array('status' => '1'))->find();
        $this->assign('info', $info);
        $bank_table = M('bank');
        $bank_list = $bank_table->order('sort desc')->where(array('is_hied' => '1'))->select();
        $this->assign('banklist', $bank_list);
        $this->display();
    }

    public function reminbitixian() {
        $type = purseType();
        $uid = session('uid');
        $userbank_table=M('userbank'); 
        $member_table = M('member');
        if (IS_AJAX) {
            $data = bonusset();
            $tixian_table = M('tixian');
          
            $bonus_table = M('bonus');
            $member_table->startTrans();
            $money = I('post.money', '', 'htmlspecialchars');
            $types = I('post.type', '', 'htmlspecialchars');
            $banktype = I('post.banktype', '', 'htmlspecialchars');
            $userbankinfo=$userbank_table->where(array('uid'=>$uid,'id'=>$banktype))->find();
            
            if($data['tixian_status']!=1){
                showMsg(2, '提现已经关闭');
            }
            
              if(strstr($money,'.')){
                    showMsg(2, '请输入整数');
                }
            if(!$userbankinfo){
                 showMsg(2, '银行卡号不存在');
            }
            if (empty($type[$types])) {
                showMsg(2, '类型不存在');
            }
            if ($money < 0 || floor($money) != $money || !is_numeric($money)) {
                showMsg(2, '请输入有效的数字');
            }
           
            
            
            if (!$tixian_table->autoCheckToken($_POST)) {
                showMsg(2, '不要重复提交');
            }
            $userInfo = $member_table->find($uid);

            switch ($types) {
                case 1:
                    $shouxifei = $money * ($data['benjinshuxufei'] / 100);
                   // $balance = $userInfo['principal'] - $shouxifei;
                   // $usermoney = $userInfo['principal'] - $money - $shouxifei;
                    $usermoney = $userInfo['principal'] - $money ;
                    $re11 = $member_table->save(array('id' => $uid, 'principal' => $usermoney));
                    break;
                case 2:
                    $shouxifei = $data['lxsxf'];
                    //$balance = $userInfo['profit'] - $shouxifei;
                   // $usermoney = $userInfo['profit'] - $money - $shouxifei;
                    $usermoney = $userInfo['profit'] - $money;
                    $re11 = $member_table->save(array('id' => $uid, 'profit' => $usermoney));
                    break;
                default :
                    showMsg(2, '类型不存在');
            }
            if ($usermoney < 0) {
                showMsg(2, '金额不足');
            }
            $relust = $this->getnumber($uid, $types);
            if (!$relust) {
                showMsg(2, '今天的次数已经提完');
            }

            $rel2 = $bonus_table->add(array('uid' => $uid, 'pursetype' => $types, 'poundage' => $shouxifei, 'type' => $types, 'export' => $money, 'status' => '2', 'create_date' => time(), 'balance' => $usermoney, 'source' => '4', 'explain' => '申请提现'));

            $rel = $tixian_table->add(array('uid' => $uid, 'money' => $money, 'pursetype' => $types, 'poundage' => $shouxifei, 'type' => $types, 'create_date' => time(), 'status' => '1', 'no' => build_order_no(),'bank'=>$userbankinfo['bank'],'bankno'=>$userbankinfo['bankno'],'username'=>$userbankinfo['username'],'kaihubank'=>$userbankinfo['kaihubank'],'userbank_id'=>$userbankinfo['id']));
            if ($rel && $rel && $rel2) {
                $this->setnumber($types, $uid);
                $member_table->commit();
                showMsg(1, '操作成功');
            } else {
                $member_table->rollback();
                showMsg(2, '操作失败');
            }
        }
        $userbanklist=$userbank_table->where(array('uid'=>$uid))->select();
        $count=count($userbanklist);
         for($i=0;$i<$count;$i++){
             $userbanklist[$i]['bankno']=substr_replace($userbanklist[$i]['bankno'], "******", 4, 4);
         }
         $user=$member_table->find($uid);
         $this->assign('principal',$user['principal']);
        $this->assign('userbanklist',$userbanklist);
        $this->assign('type', $type);
        $this->display();
    }

    protected function selftotal($uid, $money) {
        $total_table = M('total');
        $row = $total_table->where(array('uid' => $uid))->find();
        if ($row) {
            $total_table->save(array('id' => $row['id'], 'selftotalmoney' => $row['selftotalmoney'] + $money, 'selftotalsum' => $row['selftotalsum'] + $money));
        } else {
            $total_table->add(array('uid' => $uid, 'selftotalmoney' => $money, 'selftotalsum' => $money));
        }
    }

    protected function grouptotal($rid, $money) {

        $member_table = M('member');
        $total_table = M('total');
        $userInfo = $member_table->field('recommend')->find($rid);
        $row = $total_table->where(array('uid' => $rid))->find();
        if ($row) {
            $total_table->save(array('id' => $row['id'], 'grouptotalmoney' => $row['grouptotalmoney'] + $money, 'grouptotalsum' => $row['grouptotalsum'] + $money));
        } else {
            $total_table->add(array('uid' => $rid, 'grouptotalmoney' => $money, 'grouptotalsum' => $money));
        }

        if ($row['recommend'] > 0) {
            self::grouptotal($row['recommend'], $money);
        }
    }


    protected function reducegrouptotal($rid, $money) {

        $member_table = M('member');
        $total_table = M('total');
        $userInfo = $member_table->field('recommend')->find($rid);
        $row = $total_table->where(array('uid' => $rid))->find();
        if ($row) {
            $total_table->save(array('id' => $row['id'], 'grouptotalmoney' => $row['grouptotalmoney'] - $money));
        } 

        if ($row['recommend'] > 0) {
            self::grouptotal($row['recommend'], $money);
        }
    }

    protected function getnumber($uid, $type) {
        $number_table = M('number');
        $row = $number_table->where(array('type' => $type, 'uid' => $uid))->find();
        $data = bonusset();
        if ($row) {
            if ($row['number'] >= $data['benjincishu']) {
                return false;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    protected function setnumber($type, $uid) {
        $number_table = M('number');
        $row = $number_table->where(array('type' => $type, 'uid' => $uid))->find();
        if ($row) {
            $number_table->save(array('id' => $row['id'], 'number' => $row['number'] + 1));
        } else {
            $number_table->add(array('uid' => $uid, 'type' => $type, 'number' => 1));
        }
    }

    public function gettouziInfo() {

        $money = I('param.param', '', 'htmlspecialchars');
        $minmoney = $this->returnminmoney();
        $data = bonusset();
        $beishu = $data['benjinbeishu'];
        if ($money % $beishu != 0) {
            $json['status'] = 'n';
            $json['info'] = '必须是：' . $beishu . '倍数';
            echo json_encode($json);
            exit;
        }
        if ($money >= $minmoney) {
            $row = $this->returnrate($money);

            $json['status'] = 'y';
            $json['info'] = $row['message'];
            echo json_encode($json);
            exit;
        } else {
            $json['status'] = 'n';
            $json['info'] = '金额不能低于：' . $minmoney;
            echo json_encode($json);
            exit;
        }
    }

    protected function returnrate($money) {
        $rate_copy_table = M('rate_copy');
        $list = $rate_copy_table->order('id desc')->select();
        for ($i = 0; $i < count($list); $i++) {
            if ($money >= $list[$i]['min']) {
                return $list[$i];
            }
        }
    }

    protected function returnminmoney() {
        $rate_copy_table = M('rate_copy');
        $info = $rate_copy_table->find(1);
        return $info['min'];
    }
    public function getallowchongzhiInfo() {
        //获取提现本金的条件
        $money = I('param.param', '', 'htmlspecialchars');
        $data = bonusset();
         if($money<$data['zuidicongzhimoney']){
            $json['status'] = 'n';
            $json['info'] ='最小充值金额'.$data['zuidicongzhimoney'];
            echo json_encode($json);
            exit;
             
            }
            if($money>$data['zuigaocongzhimoney']){
                $json['status'] = 'n';
            $json['info'] = '最高充值金额'.$data['zuigaocongzhimoney'];
            echo json_encode($json);
            exit;
            }
            if($money%$data['chongzhimoneybeishu']!=0){
                 $json['status'] = 'n';
            $json['info'] ='最高充值金额必须是'.$data['chongzhimoneybeishu'].'倍数';
            echo json_encode($json);
            exit;
                 
            }
             $json['status'] = 'y';
            $json['info'] = '通过信息验证！ ';
            echo json_encode($json);
            exit;
     
    }
    public function getallowInfo() {
        //获取提现本金的条件
        $money = I('param.param', '', 'htmlspecialchars');
        $id = I('param.name', '', 'htmlspecialchars');
        $minmoney = $this->returnminmoney($money);
        $relust = $this->allowtixianmoney($money, $id);
        $invest_table = M('invest');
        $row = $invest_table->find($id);
        $data = bonusset();
        if ($row['day'] < $data['benjintianshu']) {
            $json['status'] = 'n';
            $json['info'] = '满' . $data['benjintianshu'] . '天方可提现';
            echo json_encode($json);
            exit;
        }
        if ($relust == 1) {
            $json['status'] = 'y';
            $json['info'] = '通过信息验证！ ';
            echo json_encode($json);
            exit;
        } else {
            if ($relust == -1) {
                $json['status'] = 'n';
                $json['info'] = '金额不足';
                echo json_encode($json);
                exit;
            } else {
                $json['status'] = 'n';
                $json['info'] = '余额低于' . $minmoney . '请全额提款';
                echo json_encode($json);
                exit;
            }
        }
    }

    protected function allowtixianmoney($money, $id) {
        $invest_table = M('invest');
        $row = $invest_table->find($id);
        $minmoney = $this->returnminmoney($money);
        $moneys = $row['money'] - $money;

        if ($money > $row['money']) {
            return -1;
        }
        if ($moneys == 0) {
            return 1;
        } else {
            if ($moneys < $minmoney) {
                return 0;
            } else {
                return 1;
            }
        }
    }

    public function getdeduct() {
        $uid = session('uid');
        $money = I('param.money', '', 'htmlspecialchars');
        $type = I('param.type', '', 'htmlspecialchars');
        $member_table = M('member');
        $data = bonusset();
       
        $userInfo = $member_table->field('principal,profit')->find($uid);
        switch ($type) {
            case 1:
                if(strstr($money,'.')){
                    showMsg(2, '请输入整数');
                }
                if ($money > $userInfo['principal']) {
                    showMsg(2, '本金钱袋金额不足');
                } else {
                    if ($money > $data['benjinzuigaotixian']) {
                        showMsg(2, '本金钱袋单次最高' . $data['benjinzuigaotixian'] . '元');
                    } else {
                        if($money<$data['benjinzuidi']){
                            showMsg(2, '本金钱袋单次最低' . $data['benjinzuidi'] . '元');
                        }
                        else{
                        showMsg(1, '需扣除' . $data['benjinshuxufei'] . "%的手续费");
                        }
                    }
                }
                break;
            case 2:
                   if(strstr($money,'.')){
                    showMsg(2, '请输入整数');
                }
                if ($money > $userInfo['profit']) {
                    showMsg(2, '收益钱袋金额不足');
                } else {
                    if ($money < $data['lxtxzxz']) {
                        showMsg(2, '收益钱袋最低' . $data['lxtxzxz'] . '起提');
                    } else {
                        showMsg(1, '需扣除' . $data['lxsxf'] . '元手续费');
                    }
                }
                break;
            default :showMsg(2, '钱袋类型不存在');
        }
    }
    
    
    //种植记录
    public function grow() {

        $uid=session('uid');
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
       
        $map['uid'] =$uid;
        $framshop_table=M('framshop');
       
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

}

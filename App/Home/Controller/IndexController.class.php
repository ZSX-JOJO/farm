<?php

namespace Home\Controller;

use Home\Controller\CommonController;

class IndexController extends CommonController {

    public function index() {
        $this->display();
    }

    public function fram() {

        $uid = session('uid');
        session('cid', $uid);
        $member_table = M('member');
        $framdepot_table = M('framdepot');

        $number = $framdepot_table->where(array('uid' => $uid))->sum('number');
        $number = empty($number) ? 0 : $number;
        $level_table = M('level');
        $userInfo = $member_table->find($uid);
        $usercount = $member_table->where(array('recommend' => $uid))->count();
        $level = $level_table->find($userInfo['level']);
        $uplevel = $level_table->find($userInfo['level'] + 1);
        $this->assign('level', $level);
        $this->assign('uplevel', $uplevel);
        $this->assign('count', $usercount);
        $this->assign('userinfo', $userInfo);
        $this->assign('number', $number);
        $this->display();
    }

    //好友农场
    public function friendFarm() {

        $type = I('get.type');
        $framdepot_table = M('framdepot');
        //直推信息
        $uid = encrypt(rawurldecode(I('get.id')), 'D', C('userlistkey'));
        if ($type == 1) {
            $cid = $this->selfline($uid);//验证是否为自己的直推
            $fuser='我的直推';
        } elseif($type==2) {
            $cid = $this->selffriend($uid);//验证是否为自己的好友
            $fuser='我的好友';
        }else{
            $this->error('类型不存在');
        }
        
        $othernumber = $framdepot_table->where(array('uid' => $uid))->sum('number');
        $othernumber = empty($othernumber) ? 0 : $othernumber;
       
        session('cid', $cid);
        $member_table = M('member');
        $level_table = M('level');
        $otheruserInfo = $member_table->find($uid);
        $otherusercount = $member_table->where(array('recommend' => $uid))->count();
        $otherlevel = $level_table->find($otheruserInfo['level']);
        $otheruplevel = $level_table->find($otheruserInfo['level'] + 1);

        $this->assign('otherlevel', $otherlevel);
        $this->assign('otheruplevel', $otheruplevel);
        $this->assign('othercount', $otherusercount);
        $this->assign('otheruserinfo', $otheruserInfo);
        $this->assign('othernumber', $othernumber);

        ///本人信息
        $userid = session('uid');
        $number = $framdepot_table->where(array('uid' => $userid))->sum('number');
        $number = empty($number) ? 0 : $number;
        $userInfo = $member_table->find($userid);
        $usercount = $member_table->where(array('recommend' => $userid))->count();
        $level = $level_table->find($userInfo['level']);
        $uplevel = $level_table->find($userInfo['level'] + 1);

        $this->assign('level', $level);
        $this->assign('uplevel', $uplevel);
        $this->assign('count', $usercount);
        $this->assign('userinfo', $userInfo);
        $this->assign('number', $number);
        $this->assign('fuser',$fuser);
        $this->display();
    }

    public function selfline($cid) {
        $uid = session('uid');
        $member_table = M('member');
        $userinfo = $member_table->field('recommend')->find($cid);
        if ($cid == $uid) {
            return $cid;
        } else {
            if ($userinfo['recommend'] == $uid) {
                return $cid;
            } else {
              $this->error( '对方不是你的直推');
            }
        }
    }

    public function selffriend($cid) {
        $uid = session('uid');
        $friends_table = M('friends');
        $userinfo = $friends_table->field('id')->where(array('uid' => $uid, 'oid' => $cid, 'status' => 2))->find();

        if ($userinfo) {
            return $cid;
        } else {
            $this->error('对方不是你的好友');
        }
    }

    //土地
    public function lands() {

        if (IS_AJAX) {

            $uid = session('cid');

            $this->autotime($uid);

            // $uid =  session('uid') ;
            $framlandtype_table = M('framlandtype');
            $list = $framlandtype_table->order('landtype asc')->where(array('uid' => $uid))->select();
            for ($i = 0; $i < count($list); $i++) {


                $second = $list[$i]['grow_date'] - time();
                $list[$i]['second'] = $this->countdown($second);
                $data = $this->fruitnumber($list[$i]['gid']);
                $list[$i]['fruitnumber'] = $data['fruitnumber'];
                $list[$i]['fruitbalance'] = $data['fruitbalance'];
                $land = $list[$i]['status'] == 0 ? land1 : land2;

                $html = '';
                if ($list[$i]['status'] == 2) {
                    $html = "<img src=\"/Public/images/home/shu0.png\" />"
                            . "<div class=\"diinfo\" style=\"opacity: 0;\">{$list[$i]['title']}  <br>{$list[$i]['second']} <br />总：{$list[$i]['fruitnumber']} 余：{$list[$i]['fruitbalance']}</div>";
                } elseif ($list[$i]['status'] == 6) {
                    $html = "<img src=\"/Public/images/home/shu6.png\" />";
                } else if ($list[$i]['status'] > 2 && $list[$i]['status'] < 5) {
                    $html = "<img src=\"/{$list[$i]['image']}\" />"
                            . "<div class=\"diinfo\" style=\"opacity: 0;\">{$list[$i]['title']}  <br>{$list[$i]['second']} <br />总：{$list[$i]['fruitnumber']} 余：{$list[$i]['fruitbalance']}</div>"
                            . "";
                } else if ($list[$i]['status'] == 5) {
                    $html = "<img src=\"/{$list[$i]['image']}\" />"
                            . "<div class=\"diinfo\" style=\"opacity: 0;\">{$list[$i]['title']}  <br>已经成熟<br />总：{$list[$i]['fruitnumber']} 余：{$list[$i]['fruitbalance']}</div>"
                            ."<div class=\"ico\" style=\"display:none\"></div>"
                            ."";
                }
                $list[$i] = "<li class=\"di d{$list[$i]['landtype']} {$land}\" id=\"di{$list[$i]['landtype']}\" onclick=\"onclickevent(this,{$list[$i]['landtype']})\"> "
                        . $html
                        . "<div class=\"zeng\" style=\"display: none;\"></div> "
                        . "<div class=\"msg\" style=\"display:none\"></div> "
                        ."<div class=\"ico\" style=\"display:none\"></div>"
                        . "</li> "
                        . "";
            }

            exit(json_encode(array('list' => $list)));
        }
    }

    //倒计时
    protected function countdown($time) {

        $remain_time = $time; //剩余的秒数
        $remain_hour = floor($remain_time / (60 * 60)); //剩余的小时
        $remain_minute = floor(($remain_time - $remain_hour * 60 * 60) / 60); //剩余的分钟数
        $remain_second = ($remain_time - $remain_hour * 60 * 60 - $remain_minute * 60); //剩余的秒数

        return "<span>" . $remain_hour . ":" . $remain_minute . ":" . $remain_second . "后成熟</span>";
        //  echo json_encode(array('hour' => $remain_hour, 'minute' => $remain_minute, 'second' => $remain_second));
    }

    //判断植物是否成熟
    protected function autotime($uid) {
        //  $uid = session('uid');
        $framlandtype_table = M('framlandtype');
        $framshop_table = M('framshop');
        $list = $framlandtype_table->where(array('uid' => $uid, 'status' => array('in', '2,3,4')))->select();

        $count = count($list);
        for ($i = 0; $i < $count; $i++) {
            $shopInfo = $framshop_table->find($list[$i]['shopid']);
            $Section = $list[$i]['grow_date'] - $list[$i]['create_date'];
            if ($list[$i]['grow_date'] - time() <= 0 && $list[$i]['status'] <= 4) {

                $framlandtype_table->save(array('id' => $list[$i]['id'], 'status' => 5, 'image' => $shopInfo['large']));
            } else if ($list[$i]['grow_date'] - time() < $Section * 0.33 && $list[$i]['status'] <= 3) {

                $framlandtype_table->save(array('id' => $list[$i]['id'], 'status' => 4, 'image' => $shopInfo['middle']));
            } else if ($list[$i]['grow_date'] - time() < $Section * 0.66 && $list[$i]['status'] <= 2) {

                $framlandtype_table->save(array('id' => $list[$i]['id'], 'status' => 3, 'image' => $shopInfo['small']));
            }
        }
    }

    //翻土
    public function plowing() {
        $uid = session('uid');
        $framlandtype = I('post.framlandtype');
        $framlandtype_table = M('framlandtype');
        $framgrow_table = M('framgrow');
        // 0 表示需要翻地，1表示可以种植，2发芽，3幼苗，4长大，5成熟,6摘取, 翻土1
        $status = $framlandtype_table->where(array('uid' => $uid, 'landtype' => $framlandtype))->find();
        switch ($status['status']) {
            case 0:
                $member_table = M('member');
                $bonus_table = M('bonus');
                $member_table->startTrans();
                $data = bonusset();
                $money = $data['kaikenmoney']; //土地费用
                $reclaim = I('post.reclaim'); //标识
                if ($reclaim == 1) { //扣除费用，开荒成功
                    $userInfo = $member_table->field('principal')->find($uid);

                    if ($userInfo['principal'] < $money) {
                        showMsg(2, '金额不足,请充值');
                    }

                    $rel = $member_table->save(array('id' => $uid, 'principal' => $userInfo['principal'] - $money));
                    $rel2 = $bonus_table->add(array('type' => 1, 'uid' => $uid, 'export' => $money, 'balance' => $userInfo['principal'] - $money, 'status' => 2, 'explain' => '土地开垦', 'create_date' => time()));
                    $rel3 = $framlandtype_table->save(array('id' => $status['id'], 'status' => '1'));
                    if ($rel && $rel2 && $rel3) {
                        $member_table->commit();
                        exit(json_encode(array('status' => 1, 'msg' => '开垦成功', 'money' => $money)));
                    } else {
                        $member_table->rollback();
                        showMsg(2, '开垦失败');
                    }
                } else {
                    //询问开荒条件
                    exit(json_encode(array('status' => 3, 'msg' => '你确定花费' . $money . '元开垦土地？')));
                }
                break;
            case 1:
                showMsg(2, '不能对空土地操作');
                break;
            case 2:
                showMsg(2, '有植物不能铲除');
                break;
            case 3:
                showMsg(2, '有植物不能铲除');
                break;
            case 4:
                showMsg(2, '有植物不能铲除');
                break;
            case 5:
                showMsg(2, '有植物不能铲除');
                break;
            case 6: $framlandtype_table->save(array('id' => $status['id'], 'status' => '1', 'manure' => 0, 'image' => '', 'title' => '', 'grow_date' => '', 'create_date' => ''));
                showMsg(1, '铲除成功');
                break;
            default:
                showMsg(2, '无需操作');
        }
    }

    //收割
    public function pick() {


        $userid = session('uid');
        $uid = session('cid');
        $framlandtype = I('post.framlandtype');
        $framgrow_table = M('framgrow');
        $framlandtype_table = M('framlandtype');
        $framdepot_table = M('framdepot');
        $member_table = M('member');
        $framdetail_table = M('framdetail');
        $member_table->startTrans();
        $status = $framlandtype_table->where(array('uid' => $uid, 'landtype' => $framlandtype))->find();
        switch ($status['status']) {
            case 0:
                showMsg(2, '土地尚未开垦');
                break;
            case 1:
                showMsg(2, '不能对空土地操作');
                break;
            case 2:
                showMsg(2, '果实尚未成熟');
                break;
            case 3:
                showMsg(2, '果实尚未成熟');
                break;
            case 4:
                showMsg(2, '果实尚未成熟');
                break;
            case 5:
                $rel = $framgrow_table->where(array('uid' => $uid, 'landtypeid' => $framlandtype, 'status' => 1))->find(); //获取该株植物的信息
                if ($userid == $uid) {
                    //摘取自己的果实



                    if ($rel) {
                        $userInfo = $member_table->field('integral,experience')->find($uid); //获取经验和积分信息
                        $data = $this->integral($framlandtype);
                        $info = $framdepot_table->where(array('shopid' => $rel['shopid'], 'uid' => $uid))->find(); //仓库信息
                        $rel1 = $framlandtype_table->save(array('id' => $status['id'], 'status' => '6')); //更新土地状态
                        $relust = $framgrow_table->save(array('id' => $rel['id'], 'status' => '2', 'pick_date' => time(), 'integral' => $data['integral'], 'experience' => $data['experience'], 'manure' => $status['manure'])); //更新种植表信息
                        $rel2 = $member_table->save(array('id' => $uid, 'integral' => $userInfo['integral'] + $data['integral'], 'experience' => $userInfo['experience'] + $data['experience'])); //更新个人信息

                        if ($info) {
                            $rel3 = $framdepot_table->where(array('id' => $info['id']))->setInc('number', $rel['fruitbalance']); //查看仓库有该品种，更新数量
                        } else {
                            $rel3 = $framdepot_table->add(array('uid' => $uid, 'shopid' => $rel['shopid'], 'number' => $rel['fruitbalance'])); //没有该品种，插入数量
                        }

                        $rel4 = $framdetail_table->add(array('uid' => $uid, 'type' => 0, 'fid' => $uid, 'gid' => $rel['id'], 'number' => $rel['fruitbalance'], 'shopid' => $rel['shopid'], 'create_date' => time())); //生成摘取记录

                        if ($relust && $rel1 && $rel2 && $rel3 && $rel4) {
                            $member_table->commit();
                            $updaterel = $this->level($data['experience']); //升级
                            if (!empty($updaterel)) {
                                exit(json_encode(array('status' => 3, 'fruitbalance' => $rel['fruitbalance'], 'integral' => '+' . $data['integral'], 'experience' => '+' . $data['experience'], 'upexperience' => $updaterel['experience'], 'title' => $updaterel['title'])));
                            } else {
                                exit(json_encode(array('status' => 1, 'fruitbalance' => $rel['fruitbalance'], 'integral' => '+' . $data['integral'], 'experience' => '+' . $data['experience'])));
                            }
                        } else {
                            $member_table->rollback();
                            showMsg(2, '操作失败');
                        }
                    } else {
                        showMsg(2, '未知错误');
                    }
                } else {
                    //别人偷摘
                    //判断是否有摘过

                    $r = $framdetail_table->field('id')->where(array('gid' => $rel['id'], 'uid' => $userid))->find();
                    if ($r) {
                        showMsg(2, '你已经偷过了！');
                    }
                    //给自己仓库加数量
                    if ($rel) {
                        if ($rel['fruitbalance'] <= 1) {
                            showMsg(2, '留点给主人把！');
                        } else {

                            $rel1 = $framgrow_table->where(array('id' => $rel['id']))->setDec('fruitbalance', 1);  //减去该土地的果实数量

                            $info = $framdepot_table->where(array('shopid' => $rel['shopid'], 'uid' => $userid))->find(); //获取本人仓库信息
                            if ($info) {
                                $rel3 = $framdepot_table->where(array('id' => $info['id']))->setInc('number', 1); //查看仓库有该品种，更新数量
                            } else {
                                $rel3 = $framdepot_table->add(array('uid' => $userid, 'shopid' => $rel['shopid'], 'number' => 1)); //没有该品种，插入数量
                            }
                            $rel2 = $framdetail_table->add(array('uid' => $userid, 'type' => 1, 'fid' => $uid, 'gid' => $rel['id'], 'number' => 1, 'shopid' => $rel['shopid'], 'create_date' => time())); //生成摘取记录
                            if ($rel1 && $rel2 && $rel3) {
                                $member_table->commit();
                                exit(json_encode(array('status' => 4, 'msg' => '+1', 'fruitbalance' => 1)));
                                //showMsg(4, '偷摘成功 +1'); //偷摘成功
                            } else {
                                $member_table->rollback();
                                showMsg(2, '偷取失败');
                            }
                        }
                    } else {
                        showMsg(2, '未知错误');
                    }
                }
                break;
            case 6:
                showMsg(2, '已经收割完了');
                break;
            default :
                showMsg('2', '类型不存在');
                break;
        }
    }

    //种子栏
    public function framseed() {
        if (IS_AJAX) {
            $uid = session('uid');
            $framseed_table = M('framseed');
            $framshop_table = M('framshop');
            $framseedlist = $framseed_table->where(array('uid' => $uid, 'number' => array('gt', '0'), 'type' => 1))->select();
            for ($i = 0; $i < count($framseedlist); $i++) {
                $row = $framshop_table->find($framseedlist[$i]['shopid']);
                $framseedlist[$i] = "<li onclick=\"plant({$framseedlist[$i]['shopid']})\" id=\"plantli{$framseedlist[$i]['shopid']}\">"
                        . "<div id=\"plantdiv{$framseedlist[$i]['shopid']}\" >{$framseedlist[$i]['number']}</div><img src=\"/{$row['thumb']}\" width=\"50\" height=\"50\" /> "
                        . "</li> "
                        . "";
            }
            exit(json_encode(array('list' => $framseedlist)));
        }
    }

    //工具栏
    public function tool() {
        if (IS_AJAX) {
            $uid = session('uid');
            $framseed_table = M('framseed');

            $framshop_table = M('framshop');
            $framseedlist = $framseed_table->where(array('uid' => $uid, 'number' => array('gt', '0'), 'type' => 2))->select();
            for ($i = 0; $i < count($framseedlist); $i++) {
                $row = $framshop_table->find($framseedlist[$i]['shopid']);
                $framseedlist[$i] = "<li onclick=\"tooltype({$framseedlist[$i]['id']})\" id=\"toolli{$framseedlist[$i]['id']}\">"
                        . "<div id=\"tooldiv{$framseedlist[$i]['id']}\" >{$framseedlist[$i]['number']}</div><img src=\"/{$row['thumb']}\" width=\"50\" height=\"50\" /> "
                        . "</li> "
                        . "";
            }
            exit(json_encode(array('list' => $framseedlist)));
        }
    }

    //工具
    public function tooltype() {
        $uid = session('uid');
        $tooltype = I('post.tooltype');
        $framseed_table = M('framseed');
        $framshop_table = M('framshop');
        $info = $framseed_table->where(array('uid' => $uid, 'id' => $tooltype))->find();
        if ($info) {
            $data = $framshop_table->find($info['shopid']);
            if ($data['type'] == 2) {//化肥
                exit(json_encode(array('ico' => $data['ico'], 'status' => 1)));
            }
        } else {

            showMsg(2, '物品不存在！');
        }
    }

    //使用道具
    public function usetool() {

        if (IS_AJAX) {
            $uid = session('uid');
            $tool = I('post.tool');
            $framlandtype = I('post.framlandtype');
            $framseed_table = M('framseed');
            $data = $framseed_table->where(array('uid' => $uid, 'id' => $tool))->find();
            if (!$data) {
                showMsg(2, '操作失败！');
            }
            if ($data['number'] > 0) {
                if ($data['type'] == 2) {
                    $this->manure($framlandtype, $tool); //施肥
                }
            } else {
                showMsg(2, '数量不足！');
            }
        }
    }

    //播种
    public function plant() {
        $uid = session('uid');
        $shopid = I('post.type');
        $framlandtype = I('post.framlandtype');
        $framlandtype_table = M('framlandtype');
        $framseed_table = M('framseed');
        $framgrow_table = M('framgrow');
        $framshop_table = M('framshop');
        $framseed_table->startTrans();
        $rel = $framshop_table->find($shopid);
        if (!$rel) {
            showMsg(2, '品种不存在');
        }
        $status = $framlandtype_table->where(array('uid' => $uid, 'landtype' => $framlandtype))->find();
        if ($status['status'] >= 2) {
            showMsg(2, '土地已经有植物了');
        } else {
            if ($status['status'] == 0) {
                showMsg(2, '请先翻土后操作');
            }
        }
        $info = $framseed_table->where(array('shopid' => $shopid, 'uid' => $uid))->find();
        if ($info['number'] > 0) {
            $rel1 = $framseed_table->save(array('id' => $info['id'], 'number' => $info['number'] - 1));
            $rel2 = $framgrow_table->add(array('uid' => $uid, 'shopid' => $shopid, 'fruitnumber' => $rel['number'], 'fruitbalance' => $rel['number'], 'landtypeid' => $framlandtype, 'status' => 1, 'create_date' => time(), 'grow_date' => time(), 'hour' => $rel['hour']));
            $rel3 = $framlandtype_table->save(array('id' => $status['id'], 'status' => '2', 'create_date' => time(), 'grow_date' => time() + 3600 * $rel['hour'], 'title' => $rel['title'], 'shopid' => $shopid, 'gid' => $rel2));
            if ($rel1 && $rel2 && $rel3) {
                $framseed_table->commit();
                exit(json_encode(array('status' => 1, 'msg' => '种植成功', 'title' => $rel['title'], 'hour' => $rel['hour'], 'fruitnumber' => $rel['number'], 'fruitbalance' => $rel['number'])));
            } else {
                $framseed_table->rollback();
                showMsg(2, '种植失败');
            }
        } else {

            showMsg(2, '种子数量不足');
        }
    }

    //施肥
    protected function manure($framlandtype, $id) {
        $userid = session('uid');
        $uid = session('cid');
        $framshop_table = M('framshop');
        $framseed_table = M('framseed');
        $framlandtype_table = M('framlandtype');
        $rel = $framlandtype_table->where(array('uid' => $uid, 'landtype' => $framlandtype))->find();
        $framinfo = $framseed_table->field('shopid,number')->where(array('type' => 2))->find($id);
        if ($framinfo['number'] <= 0) {
            showMsg(2, '物品不存在');
        }


        $framseed_table->startTrans();
        if ($rel['status'] == 0) {
            showMsg(2, '土地尚未开垦');
        } else if ($rel['status'] == 1) {
            showMsg(2, '不能对空土地操作');
        } else if ($rel['status'] >= 2 && $rel['status'] < 5) {
            if ($rel['manure'] > 0) {
                showMsg(2, '只能使用一次道具');
            } else {
                $hour = $framshop_table->field('hour')->find($framinfo['shopid']);
                $deltime = $hour['hour'] * 3600; //缩短的时间
                $relust1 = $framlandtype_table->where(array('uid' => $uid, 'landtype' => $framlandtype))->setdec('grow_date', $deltime); //
                $relust = $framlandtype_table->where(array('uid' => $uid, 'landtype' => $framlandtype))->setInc('manure', '1');
                $relust2 = $framseed_table->where(array('id' => $id, 'uid' => $userid))->setdec('number', '1');
                if ($relust && $relust1 && $relust2) {
                    $framseed_table->commit();
                    showMsg(1, '缩短了生长周期');
                } else {
                    $framseed_table->rollback();
                    showMsg(2, '操作失败');
                }
            }
        } else {
            showMsg(2, '无须施肥');
        }
    }

    protected function fruitnumber($id) {
        $framgrow_table = M('framgrow');
        $data = $framgrow_table->field('fruitnumber,fruitbalance')->find($id);
        return $data;
    }

    //积分和经验值
    protected function integral($landtype) {
        $uid = session('uid');
        $framlandtype_table = M('framlandtype');
        $framshop_table = M('framshop');
        $rel = $framlandtype_table->where(array('uid' => $uid, 'landtype' => $landtype))->find();
        $relust = $framshop_table->find($rel['shopid']);
        $data = array('integral' => $relust['integral'], 'experience' => $relust['experience']);
        return $data;
    }

    //用户直推列表
    public function userlevellist($p = 1) {
        $uid = session('uid');
        $member_table = M('member');
        $count = $member_table->where(array('recommend' => $uid))->count();
        $Page = new \Think\Page($count, 8);
        $show = $Page->show();
        $list = $member_table->where(array('recommend' => $uid))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $counts = count($list);

        for ($i = 0; $i < $counts; $i++) {
            $userid = rawurlencode(encrypt($list[$i]['id'], 'E', C('userlistkey')));
            $no = $p * $Page->listRows - $Page->listRows + $i + 1;
            $list[$i]['level'] = $list[$i]['level'] - 1;
            $list[$i] = " <tr>"
                    . "<td width=\"10%\" style=\"font-weight: bold;\">{$no}</td>"
                    . "<td width=\"20%\"><a href=\"friendFarm/id/{$userid}/type/1\" style=\"font-size:initial\" ><img src=\"/Public/images/home/t.jpg\" height=\"35px\" width=\"35px\"></a></td>"
                    . "<td><a href=\"friendFarm/id/{$userid}/type/1\" style=\"font-size:initial\"><font style=\"font-weight: bold;color: #85b200\">Lv{$list[$i]['level']}</font><br><font class=\"listti\" style=\"margin-left: 10px\" >{$list[$i]['username']}</font></a></td>"
                    . " </tr>"
                    . "";
        }
        $firspage = $p < 2 ? 1 : $p - 1;
        $Page->totalPages = empty($Page->totalPages) ? 1 : $Page->totalPages;
        $nextpage = $p > $Page->totalPages - 1 ? $Page->totalPages : $p + 1;
        $show = "<a  onclick=\"userlevellist(1)\">首页</a>"
                . "<img src=\"/Public/images/home/left.png\" onclick=\"userlevellist($firspage)\" >"
                . "<span>$p/$Page->totalPages</span>"
                . "<img src=\"/Public/images/home/right.png\" onclick=\"userlevellist($nextpage)\">"
                . "<a onclick=\"userlevellist($Page->totalPages)\">尾页</a>"
                . "";

        exit(json_encode(array('list' => $list, 'page' => $show)));
    }

//好友表
    public function friends($p = 1) {
        $uid = session('uid');
        $member_table = M('member');
        $friends_table = M('friends');
        $count = $friends_table->where(array('uid' => $uid, 'status' => 2))->count();
        $Page = new \Think\Page($count, 8);
        $show = $Page->show();
        $list = $friends_table->where(array('uid' => $uid, 'status' => 2))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $counts = count($list);

        for ($i = 0; $i < $counts; $i++) {
            $user = $member_table->field('level,username')->find($list[$i]['oid']);
            $list[$i]['level'] = $user['level'];
            $list[$i]['username'] = $user['username'];
            $userid = rawurlencode(encrypt($list[$i]['oid'], 'E', C('userlistkey')));
            $no = $p * $Page->listRows - $Page->listRows + $i + 1;
            $list[$i]['level'] = $list[$i]['level'] - 1;
            $list[$i] = " <tr>"
                    . "<td width=\"10%\" style=\"font-weight: bold;\">{$no}</td>"
                    . "<td width=\"20%\"><a href=\"friendFarm/id/{$userid}/type/2\" style=\"font-size:initial\" ><img src=\"/Public/images/home/t.jpg\" height=\"35px\" width=\"35px\"></a></td>"
                    . "<td><a href=\"friendFarm/id/{$userid}/type/2\" style=\"font-size:initial\"><font style=\"font-weight: bold;color: #85b200\">Lv{$list[$i]['level']}</font><br><font class=\"listti\" style=\"margin-left: 10px\" >{$list[$i]['username']}</font></a></td>"
                    . " </tr>"
                    . "";
        }
        $firspage = $p < 2 ? 1 : $p - 1;
        $Page->totalPages = empty($Page->totalPages) ? 1 : $Page->totalPages;
        $nextpage = $p > $Page->totalPages - 1 ? $Page->totalPages : $p + 1;
        $show = "<a  onclick=\"userlevellist(1)\">首页</a>"
                . "<img src=\"/Public/images/home/left.png\" onclick=\"friends($firspage)\" >"
                . "<span>$p/$Page->totalPages</span>"
                . "<img src=\"/Public/images/home/right.png\" onclick=\"friends($nextpage)\">"
                . "<a onclick=\"userlevellist($Page->totalPages)\">尾页</a>"
                . "";

        exit(json_encode(array('list' => $list, 'page' => $show)));
    }

    //搜索
    public function search() {
        $username = I('post.username');
        $member_table = M('member');
        $row = $member_table->where(array('username' => $username))->find();
        if ($row) {
            $row = "<tr>"
                    . "<td width=\"10%\" style=\"font-weight: bold;\">1</td>"
                    . "<td width=\"20%\"><img src=\"/Public/images/home/t.jpg\" height=\"35px\" width=\"35px\"></td>"
                    . "<td><font style=\"font-weight: bold;color: #85b200\">Lv{$row['level']}</font><br><font class=\"listti\" style=\"margin-left: 10px\">{$row['username']}</font></td>"
                    . " </tr>"
                    . "";
            exit(json_encode(array('list' => $row)));
        } else {
            
            
            
            
            
            $row = "<tr>"
                    . "<td><font style=\"font-weight: bold;color: #85b200\">未找到！！</font></td>"
                    . " </tr>"
                    . "";
            exit(json_encode(array('list' => $row)));
        }
    }

    //商店
    public function shop() {
        $framshop_table = M('framshop');
        $list = $framshop_table->where(array('status' => 1, 'type' => 1))->select();
        $toollist = $framshop_table->where(array('status' => 1, 'type' => 2))->select();
        $this->assign('list', $list);
        $this->assign('toollist', $toollist);
        $this->display();
    }

    //买种子
    public function buy() {
        $uid = session('uid');
        $member_table = M('member');
        $framshop_table = M('framshop');
        $framseed_table = M('framseed');
        $bonus_table = M('bonus');
        $member_table->startTrans();

        if (IS_POST) {
            $type = I('post.type');
            $number = I('post.number');
            $info = $framshop_table->find($type);
            $userinfo = $member_table->find($uid);
            if ($userinfo['level'] < $info['level']) {
                showMsg(2, '等级不够');
            }
            if ($info) {
                $money = $info['money'] * $number;
                if ($money > $userinfo['principal']) {
                    showMsg(2, '金额不足');
                } else {
                    $rel = $framseed_table->where(array('shopid' => $type, 'uid' => $uid))->find();
                    if ($rel) {
                        $rel1 = $framseed_table->where(array('id' => $rel['id']))->setInc('number', $number);
                    } else {
                        $rel1 = $framseed_table->add(array('shopid' => $type, 'uid' => $uid, 'number' => $number, 'type' => $info['type']));
                    }
                    $buytype = $info['type'] == 1 ? '种子' : '';
                    $rel2 = $member_table->where(array('id' => $uid))->setDec('principal', $money);
                    $rel3 = $bonus_table->add(array('uid' => $uid, 'type' => '1', 'status' => 2, 'export' => $money, 'create_date' => time(), 'balance' => $userinfo['principal'] - $money, 'explain' => '购买' . $info['title'] . $buytype . '*' . $number));
                    if ($rel1 && $rel2 && $rel3) {
                        $member_table->commit();
                        exit(json_encode(array('status' => 1, 'msg' => '购买成功', 'type' => $info['type'])));
                    } else {
                        $member_table->rollback();
                        showMsg(2, '购买失败');
                    }
                }
            } else {
                showMsg(2, '参数错误');
            }
        }

        $id = I('get.id');
        $row = $framshop_table->find($id);
        $level = M('level')->find($row['level']);
        $row['level'] = $level['title'];
        $this->assign('row', $row);
        $this->display();
    }

    //买道具
    public function buytool() {
        $framshop_table = M('framshop');
        $id = I('get.id');
        $row = $framshop_table->find($id);
        $level = M('level')->find($row['level']);
        $row['level'] = $level['title'];
        $this->assign('row', $row);
        $this->display();
    }

    //仓库
    public function depot() {
        $uid = session('uid');
        if (IS_AJAX) {


            $framdepot_table = M('framdepot');
            $framshop_table = M('framshop');
            $list = $framdepot_table->where(array('uid' => $uid, 'number' => array('gt', '0')))->select();
            $count = count($list);
            for ($i = 0; $i < $count; $i++) {
                $img = $list[$i]['lock'] == 0 ? jiesuo : lock;
                $info = $framshop_table->find($list[$i]['shopid']);
                $list[$i] = "<li id=\"\" fwin=\"gfarm\">"
                        . "<div style=\"position: absolute;\">"
                        . "<div class=\"showattr\">"
                        . "<div class=\"showborder\">"
                        . "<div id=\"\" onclick=\"layer_page('420','320','个人仓库','/Home/Index/sell/id/{$list[$i]['id']}.html')\" fwin=\"gfarm\">"
                        . "<img src=\"/{$info['small']}\" width=\"40px\" title=\"\">"
                        . "<div class=\"bottomlevel\"></div>	"
                        . "</div>"
                        . "<div class=\"toplock\"  id=\"lock_{$list[$i]['id']}\"  "
                        . " style=\"background-image:url('/Public/images/home/shop/{$img}.png')\" "
                        . "  \" onclick=\"lock(this,{$list[$i]['id']})\" fwin=\"gfarm\">			"
                        . "</div>"
                        . "</div>"
                        . "<div class=\"depotnum\">"
                        . "{$list[$i]['number']}</div>"
                        . "</div>"
                        . "</div>"
                        . "</li>"
                        . "";
            }
            $totalmoney = $this->totalmoney();
            exit(json_encode(array('list' => $list, 'totalmoney' => $totalmoney['total'], 'principal' => $totalmoney['principal'], 'fruitbalance' => $totalmoney['fruitbalance'])));
        }


        $this->display();
    }

    //总收益
    protected function totalmoney() {
        $uid = session('uid');
        $member_table = M('member');
        $framdepot_table = M('framdepot');
        $framshop_table = M('framshop');
        $list = $framdepot_table->where(array('uid' => $uid, 'number' => array('gt', '0')))->select();
        $userinfo = $member_table->field('principal')->find($uid);
        $fruitbalance = $framdepot_table->where(array('uid' => $uid))->sum('number');
        $count = count($list);
        $total = 0;
        for ($i = 0; $i < $count; $i++) {
            $shopInfo = $framshop_table->field('sellmoney')->find($list[$i]['shopid']);

            $money = $list[$i]['number'] * $shopInfo['sellmoney'];
            $total+=$money;
        }

        $total = $total == null ? 0 : $total;
        return array('total' => $total, 'principal' => $userinfo['principal'], 'fruitbalance' => $fruitbalance);
    }

    //上锁
    public function lock($id) {
        $framdepot_table = M('framdepot');
        if (IS_AJAX) {
            $uid = session('uid');
            $info = $framdepot_table->where(array('uid' => $uid, 'id' => $id))->find();
            if ($info) {
                switch ($info['lock']) {
                    case 0:
                        $framdepot_table->save(array('id' => $id, 'lock' => 1));
                        exit(json_encode(array('status' => 1)));
                        break;

                    case 1:
                        $framdepot_table->save(array('id' => $id, 'lock' => 0));
                        exit(json_encode(array('status' => 0)));
                        break;
                }
            } else {
                showMsg(2, '参数错误');
            }
        }
    }

    //一键上锁
    public function locktotal() {
        if (IS_AJAX) {
            $framdepot_table = M('framdepot');
            $uid = session('uid');
            $relust = $framdepot_table->where(array('uid' => $uid))->save(array('lock' => 1));
            if ($relust) {
                showMsg(1, '锁定成功');
            } else {
                showMsg(2, '失败');
            }
        }
    }

    //卖
    public function sell() {


        $uid = session('uid');
        $member_table = M('member');
        $framdepot_table = M('framdepot');
        $framshop_table = M('framshop');
        $bonus_table = M('bonus');
        $member_table->startTrans();
        if (IS_AJAX) {

            $id = I('post.id');
            $number = I('post.number');
            $userinfo = $member_table->find($uid);
            $rel = $framdepot_table->where(array('uid' => $uid, 'id' => $id))->find();
            if ($number > $rel['number']) {
                showMsg(2, '数量超过最大值');
            }
            if ($rel['lock'] == 1) {
                showMsg(2, '锁定无法操作');
            }
            $shopinfo = $framshop_table->find($rel['shopid']);
            if ($rel) {
                $money = $number * $shopinfo['sellmoney'];
                $rel1 = $member_table->save(array('id' => $uid, 'principal' => $userinfo['principal'] + $money));
                $rel2 = $framdepot_table->where(array('shopid' => $rel['shopid']))->setDec('number', $number);
                $rel3 = $bonus_table->add(array('uid' => $uid, 'type' => '1', 'status' => 1, 'sum' => $money, 'create_date' => time(), 'balance' => $userinfo['principal'] + $money, 'explain' => '卖出' . $shopinfo['title'] . "果实*" . $number));
                if ($rel1 && $rel2 && $rel3) {
                    $member_table->commit();
                    showMsg(1, '成功卖出');
                } else {

                    $member_table->rollback();
                    showMsg(2, '操作失败');
                }
            }
        }
        $id = I('get.id');
        $info = $framdepot_table->where(array('uid' => $uid, 'id' => $id))->find();
        if ($info) {
            $data = $framshop_table->find($info['shopid']);
            $level = M('level')->find($data['level']);
            $data['level'] = $level['title'];
        }
        $this->assign('info', $info);
        $this->assign('data', $data);
        $this->display();
    }

    //一键卖出
    public function totalsell() {

        $uid = session('uid');
        $member_table = M('member');
        $framdepot_table = M('framdepot');
        $framshop_table = M('framshop');
        $bonus_table = M('bonus');
        $member_table->startTrans();
        if (IS_AJAX) {
            $list = $framdepot_table->where(array('uid' => $uid, 'number' => array('gt', '0'), 'lock' => 0))->select();
            if ($list) {
                $count = count($list);
                for ($i = 0; $i < $count; $i++) {
                    $userinfo = $member_table->find($uid);
                    $shopinfo = $framshop_table->find($list[$i]['shopid']);
                    $money = $list[$i]['number'] * $shopinfo['sellmoney'];
                    $rel1 = $member_table->save(array('id' => $uid, 'principal' => $userinfo['principal'] + $money));
                    $rel2 = $framdepot_table->where(array('shopid' => $list[$i]['shopid']))->setDec('number', $list[$i]['number']);
                    $rel3 = $bonus_table->add(array('uid' => $uid, 'type' => '1', 'status' => 1, 'sum' => $money, 'create_date' => time(), 'balance' => $userinfo['principal'] + $money, 'explain' => '卖出' . $shopinfo['title'] . "果实*" . $list[$i]['number']));
                    if ($rel1 && $rel2 && $rel3) {
                        $member_table->commit();
                    } else {
                        $member_table->rollback();
                    }
                }
                showMsg(1, '成功卖出');
            } else {
                showMsg(2, '没有果实可以卖出');
            }
        }
    }

    //排行榜
    public function ranking($p = 1) {

        if (IS_AJAX) {
            $uid = session('uid');
            $member_table = M('member');
            $level_table = M('level');
            $count = $member_table->count();

            $Page = new \Think\Page($count, 10);
            $show = $Page->show();
            $sql = "select (select count(1)+1 
                    from (select id,sum(`level`) `level` 
                    from web_member group by id) a where a.`level`>m.`level` ) as rank
                    from (select id,sum(`level`) `level` from web_member group by id)  m where m.id={$uid};";
            $rank = M()->query($sql);

            $list = M()->query("select m.username,m.`level`, (select count(1)+1 from (select id,sum(`level`) `level` from web_member group by id) a where a.`level`>m.`level` ) as rank
            from (select id,sum(`level`) `level`,username from web_member group by id   ) m  ORDER BY `rank` LIMIT {$Page->firstRow},{$Page->listRows};");
            $counts = count($list);

            for ($i = 0; $i < $counts; $i++) {
                $levelinfo = $level_table->field('title')->find($list[$i]['level']);
                $no = $p * $Page->listRows - $Page->listRows + $i + 1;
                $list[$i] = "<tr>"
                        . "<td>{$no}</td>"
                        . "<td>{$list[$i]['rank']}</td>"
                        . "<td align=\"left\"><img src=\"/Public/images/home/avater/01_avatar_middle.jpg\">{$list[$i]['username']}</td>"
                        . "<td>{$levelinfo['title']}</td>"
                        . "</tr>"
                        . "";
            }
            $firspage = $p < 2 ? 1 : $p - 1;
            $nextpage = $p > $Page->totalPages - 1 ? $Page->totalPages : $p + 1;

            $show = "<img class=\"turnl\" src=\"/Public/images/home/ranking/turnl.png\" onclick=\"ranking($firspage)\">"
                    . "<img class=\"turnr\" src=\"/Public/images/home/ranking/turnr.png\" onclick=\"ranking($nextpage)\">"
                    . "$p/$Page->totalPages";

            exit(json_encode(array('list' => $list, 'page' => $show, 'rank' => $rank[0]['rank'])));
        }
        $this->display();
    }

    //升级
    public function level($experience) {
        $uid = session('uid');
        $member_table = M('member');
        $level_table = M('level');
        $info = $member_table->field('experience,level')->find($uid);
        $levelInfo = $level_table->find($info['level'] + 1);
        if ($info['experience'] + $experience >= $levelInfo['experience']) {
            $rel = $member_table->where(array('id' => $uid))->setInc('level', '1');
            if ($rel) {
                $row = $level_table->find($info['level'] + 2);
                return array('experience' => $row['experience'], 'title' => $levelInfo['title']);
            }
        }
    }

}

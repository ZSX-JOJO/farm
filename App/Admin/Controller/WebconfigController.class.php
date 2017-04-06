<?php

namespace Admin\Controller;

use Admin\Controller\CommonController;

class WebconfigController extends CommonController {
    /*     * *
     *
     * 系统设置
     */

    public function index() {

        $webconfig = M('webconfig');
        if (IS_POST) {


            $arr = array(
                'id' => '1',
                'value' => json_encode($_POST),
            );

            $rel = $webconfig->save($arr);
            if ($rel) {

                showMsg(1, '修改成功');
            } else {
                showMsg(2, '修改失败');
            }
        }
        $webconfig = $webconfig->where('id=1')->find();
        $arr = json_decode($webconfig['value'], true);
        $this->assign('config', $arr);
        $this->display();
    }

    public function banklist() {
        $bank_table = M('bank');
        $bank_list = $bank_table->order('sort desc')->select();
        $count = count($bank_list);
        $this->assign('count', $count);
        $this->assign('banklist', $bank_list);
        $this->display();
    }

    public function bank_start() {
        $bank_table = M('bank');
        $relsult = $bank_table->where(array('id' => I('get.id')))->find();
        if ($relsult['is_hied'] == 2) {
            $data['id'] = I('get.id');
            $data['is_hied'] = 1;
            $rel = $bank_table->save($data);
            if ($rel) {
                $json['status'] = 1;
                echo json_encode($json);
                exit;
            } else {

                showMsg(2, '操作失败');
            }
        }
    }

    public function bank_stop() {
        $bank_table = M('bank');
        $id = I('get.id');
        $result = $bank_table->where(array('id' => $id))->find();
        if ($result['is_hied'] == 1) {
            $data['id'] = $id;
            $data['is_hied'] = 2;
            $rel = $bank_table->save($data);
            if ($rel) {
                $json['status'] = 1;
                echo json_encode($json);
                exit;
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

    public function bankadd() {
        if (IS_AJAX) {
            $bank_table = M('bank');
            $bankname = I('post.bankname');
            $sort = I('post.sort');
            $relust = $bank_table->add(array('bankname' => $bankname, 'sort' => $sort));
            if ($relust) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        } else {
            $this->display();
        }
    }

    public function bankedit() {
        $bank_table = M('bank');
        if (IS_AJAX) {
            $id = I('post.id');
            $bankname = I('post.bankname');
            $sort = I('post.sort');
            $relust = $bank_table->save(array('id' => $id, 'bankname' => $bankname, 'sort' => $sort));
            if ($relust) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        } else {
            $id = I('get.id');
            $bankinfo = $bank_table->find($id);
            $this->assign('bankinfo', $bankinfo);
            $this->assign('id', $id);
            $this->display();
        }
    }

    public function bankdel() {

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $bank_table = M('bank');
            $id = $_GET['id'];
            $relust = $bank_table->delete($id);
            if ($relust) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

    public function duebankDel() {

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $bank_table = M('duebank');
            $id = $_GET['id'];
            $relust = $bank_table->delete($id);
            if ($relust) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

    public function duebank() {
        $duebank_table = M('duebank');
        $duebank_list = $duebank_table->select();
        $count = count($duebank_list);
        $this->assign('count', $count);
        $this->assign('banklist', $duebank_list);
        $this->display();
    }

    public function duebankadd() {
        if (IS_AJAX) {
            $duebank_table = M('duebank');
            $bankname = I('post.bankname');
            $bankno = I('post.bankno');
            $username = I('post.username');
            $result = $duebank_table->add(array('bankname' => $bankname, 'bankno' => $bankno, 'username' => $username, 'admin_id' => session('userid'), 'status' => 2, 'create_date' => time(), 'replace_date' => time()));
            if ($result) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        } else {
            $this->display();
        }
    }

    public function duebankedit() {
        $duebank_table = M('duebank');

        if (IS_AJAX) {
            $id = I('post.id');
            $bankname = I('post.bankname');
            $bankno = I('post.bankno');
            $username = I('post.username');
            $relust = $duebank_table->save(array('id' => $id, 'bankname' => $bankname, 'bankno' => $bankno, 'username' => $username, 'admin_id' => session('userid'), 'replace_date' => time()));
            if ($relust) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        } else {
            $id = I('get.id');
            $bankinfo = $duebank_table->find($id);
            $this->assign('bankinfo', $bankinfo);
            $this->assign('id', $id);
            $this->display();
        }
    }

    public function duebank_start() {
        $bank_table = M('duebank');
        $relsult = $bank_table->where(array('id' => I('get.id')))->find();
        if ($relsult['status'] == 2) {
            $data['id'] = I('get.id');
            $data['status'] = 1;
            $rel = $bank_table->save($data);
            if ($rel) {
                $json['status'] = 1;
                echo json_encode($json);
                exit;
            } else {

                showMsg(2, '操作失败');
            }
        }
    }

    public function duebank_stop() {
        $bank_table = M('duebank');
        $id = I('get.id');
        $result = $bank_table->where(array('id' => $id))->find();
        if ($result['status'] == 1) {
            $data['id'] = $id;
            $data['status'] = 2;
            $rel = $bank_table->save($data);
            if ($rel) {
                $json['status'] = 1;
                echo json_encode($json);
                exit;
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

    public function setbonus() {
        $webconfig = M('webconfig');
        if (IS_POST) {
            $data = array(
                'id' => '2',
                'value' => json_encode($_POST),
            );

            $rel = $webconfig->save($data);
            if ($rel) {
                $this->success('修改成功！');
                exit;
            } else {
                $this->error('修改失败！');
                exit;
            }
        }
        $setparameter = $webconfig->where('id=2')->find();
        $relust = json_decode($setparameter['value'], true);
        $this->assign('setparameter', $relust);
        C('TOKEN_ON', false);
        $this->display();
    }


}

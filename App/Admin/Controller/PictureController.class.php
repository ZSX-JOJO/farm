<?php

namespace Admin\Controller;

use Admin\Controller\CommonController;

class PictureController extends CommonController {
    /*     * *
     *
     * 图片列表 
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
        if (!empty($_REQUEST['search_type'])) {
            $map['type'] = $_REQUEST['search_type'];
            $search['search_type'] = $_REQUEST['search_type'];
        }


        $admin_table=M('admin');
        $picture_table = M('picture');
        $count = $picture_table->where($map)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count,5); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show(); //
        $list = $picture_table->order('id desc')->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $counts=count($list);
        for($i=0;$i<$counts;$i++){
        $adminInfo=$admin_table->field('username')->find($list[$i]['admin_id']);
        $list[$i]['admin']=$adminInfo['username'];
        }
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('arr', $search);
        $pictureType=getPictureType();
        $this->assign('type',$pictureType);
        $this->assign('adminInfo',$adminInfo);
        $this->display();
    }

    //删除图片
    public function pictureDel() {
        $id = I('get.id');
        $picture_table = M('picture');
        $pictureInfo = $picture_table->where(array('id' => $id))->find();
        $relust = $picture_table->where(array('id' => $id))->delete();
        if ($relust){
            unlink( $pictureInfo['image_path']);
            unlink( $pictureInfo['image_path_thumb']);
            showMsg(1, '操作成功');
        } else {
            showMsg(2, '操作失败');
        }
    }

   
    public function datadelPicture() {
        $picture_table = M('picture');
        $str = I('get.str');
        $str = trim($str, ',');
        $data['id'] = array('in', $str);
        $pictureInfo = $picture_table->where($data)->select();
        $relust = $picture_table->where($data)->delete();
        if ($relust) {
            $count=count($pictureInfo);
            for ($i = 0; $i < $count; $i++) {
                 unlink( $pictureInfo[$i]['image_path']);
                 unlink( $pictureInfo[$i]['image_path_thumb']);
            }

            showMsg(1, '操作成功');
        } else {
            showMsg(2, '操作失败');
        }
    }

    //修改图片信息
    public function pictureedit() {
        $picture_table = M('picture');
        if (IS_POST) {
                $pid=$_REQUEST['pid'];
                $type=$_REQUEST['picturetype'];
                $upload = new \Think\Upload();
                $upload->maxSize = 3145728; // 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
                $upload->rootPath = 'Public/upload/'; // 设置附件上传根目录
                $upload->savePath = 'picture/'; // 设置附件上传（子）目录
                $info = $upload->upload();
                foreach ($info as $file) {
                    $file_path = 'Public/upload/' . $file['savepath'] . $file['savename'];
                    $file_min = 'Public/upload/' . $file['savepath'] . 'thumb_' . $file['savename'];
                   
                    $relust = $picture_table->save(array('id'=>$pid,'image_path' => $file_path, 'image_path_thumb' => $file_min, 'replace_date' => time(), 'admin_id' => session('userid'),'type'=>$type));
                }
                $image = new \Think\Image();
                $image->open($file_path);
                $image->thumb(183, 183)->save($file_min);
                if (!$info && !$relust) {
                  $this->ajaxReturn($upload->getError());
                } else {  
                   $this->ajaxReturn($info);
                }
          
        } else {
            $id = I('get.id');
            $data=$picture_table->find($id);
            $pictureType=  getPictureType();
            $this->assign('type',$pictureType);
            $this->assign('id', $id);
            $this->assign('data',$data);
            $this->display();
        }
    }

    public function pictureadd() {
        if (IS_POST) {
            $type=$_REQUEST['picturetype'];
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728; // 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->rootPath = 'Public/upload/'; // 设置附件上传根目录
            $upload->savePath = 'picture/'; // 设置附件上传（子）目录
            $info = $upload->upload();
            foreach ($info as $file) {
                $file_path = 'Public/upload/' . $file['savepath'] . $file['savename'];
                $file_min = 'Public/upload/' . $file['savepath'] . 'thumb_' . $file['savename'];
                $picture_table = M('picture');
                $relust = $picture_table->add(array('image_path' => $file_path, 'image_path_thumb' => $file_min, 'create_date' => time(),'replace_date'=>time(), 'admin_id' => session('userid'),'type'=>$type));
            }
            $image = new \Think\Image();
            $image->open($file_path);
            $image->thumb(183, 183)->save($file_min);
            if (!$info && !$relust) {
                $this->ajaxReturn($upload->getError());
            } else {

                $this->ajaxReturn($info);
            }
        } else {
            $pictureType=  getPictureType();
            $this->assign('type',$pictureType);
            $this->assign('id', $id);
            $this->display();
        }
    }

    //停用图片
    public function picture_stop() {

        $picture_table = M('picture');
        $relsult = $picture_table->where('id=' . I('get.id'))->find();
        if ($relsult['status'] == 1) {
            $data['id'] = I('get.id');
            $data['status'] = 2;
            $rel1 = $picture_table->save($data);
            if ($rel1) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

//启用图片

    public function picture_start() {

        $picture_table = M('picture');
        $relsult = $picture_table->where('id=' . I('get.id'))->find();
        if ($relsult['status'] == 2) {
            $data['id'] = I('get.id');
            $data['status'] = 1;
            $rel1 = $picture_table->save($data);
            if ($rel1) {
                showMsg(1, '操作成功');
            } else {
                showMsg(2, '操作失败');
            }
        }
    }

}

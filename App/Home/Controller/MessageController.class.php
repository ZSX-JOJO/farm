<?php

namespace Home\Controller;

use Home\Controller\CommonController;

class MessageController extends CommonController {

    //信件列表
    public function index() {

        $uid = session('uid');
        $message_table = M('message');
        $count = $message_table->where(array('uid' => $uid))->count();
        $Page = new \Think\Page($count, 50);
        $show = $Page->show();
        $list = $message_table->order('addtime desc')->where(array('uid' => $uid))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    //发件箱
    public function messageadd() {
        if (IS_POST) {
            $message_table = M('message');
            $subject = I('post.subject', '', 'htmlspecialchars');
            $content = I('post.content', '', 'htmlspecialchars');
            $uid = session('uid');
            if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
                $photo_types = array('image/jpg', 'image/jpeg', 'image/png', 'image/pjpeg', 'image/gif', 'image/bmp', 'image/x-png'); //定义上传格式
                $max_size = 20000000;    //上传照片大小限制,默认700k
                $photo_folder = C('MEMBER_UPLOAD_DIR') . 'message/' .date('Y-m-d'). "/";
                ///////////////////////////////////////////////////开始处理上传
                if (!file_exists($photo_folder)) {//检查照片目录是否存在
                    mkdir($photo_folder, 0777, true);  //mkdir("temp/sub, 0777, true);
                }

                $upfile = $_FILES['upfile'];
                $name = $upfile['name'];
                $type = $upfile['type'];
                $size = $upfile['size'];
                $tmp_name = $upfile['tmp_name'];

                $file = $_FILES["upfile"];
                $photo_name = $file["tmp_name"];
                $photo_size = getimagesize($photo_name);
                if ($max_size < $file["size"]) {//检查文件大小
                    showMsg(2, '文件超过规定大小');
                }
                if (!in_array($file["type"], $photo_types)) {//检查文件类型
                    showMsg(2,'文件类型不符' );
                }
                if (!file_exists($photo_folder)) {//照片目录
                    mkdir($photo_folder);
                }
                 $pinfo = pathinfo($file["name"]);
                $photo_type = $pinfo['extension']; //上传文件扩展名
                $time = time();
                $photo_server_folder = $photo_folder .$time.  "." . $photo_type; //以当前时间和7位随机数作为文件名，这里是上传的完整路径
                if (!move_uploaded_file($photo_name, $photo_server_folder)) {
                    showMsg(2,'移动文件出错');
                } else {
                    if (!$message_table->autoCheckToken($_POST)) {
                  showMsg(2, '操作失败');
              }
               
              $result = $message_table->add(array('subject' => $subject, 'content' => $content, 'uid' => $uid, 'addtime' => time(),'picture'=>$photo_server_folder));
                   showMsg(1, '操作成功');
                }
            }else{

                if (!$message_table->autoCheckToken($_POST)) {
                 showMsg(2, '操作失败');
              }
              $result = $message_table->add(array('subject' => $subject, 'content' => $content, 'uid' => $uid, 'addtime' => time()));
               if ($result) {
                  showMsg(1, '操作成功');
              } else {
                   showMsg(2, '操作失败');
               
              }
            } 
          
          
        } else {
            $this->display();
        }
    }

    //内容页
    public function messageshow() {
        if (IS_GET) {

            $message_table = M('message');
            $id = $bankno = I('get.id', '', 'htmlspecialchars');
            $row = $message_table->find($id);
            $this->assign('row', $row);
            $this->assign('type', $array);
        }

        $this->display();
    }

}

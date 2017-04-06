<?php

namespace Home\Controller;

use Home\Controller\CommonController;

class PictureController extends CommonController {

    public function natural() {
        $picture_table = M('picture');
        $count = $picture_table->where(array('status' => '1','type'=>'1'))->count();
        $Page = new \Think\Page($count, 12);
        $show = $Page->show();
        $list = $picture_table->order('id desc')->where(array('status' => '1','type'=>'1'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    public function humanity() {
        $picture_table = M('picture');
        $count = $picture_table->where(array('status' => '1','type'=>'2'))->count();
        $Page = new \Think\Page($count, 12);
        $show = $Page->show();
        $list = $picture_table->order('id desc')->where(array('status' => '1','type'=>'2'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    public function building() {
        $picture_table = M('picture');
        $count = $picture_table->where(array('status' => '1','type'=>'3'))->count();
        $Page = new \Think\Page($count, 12);
        $show = $Page->show();
        $list = $picture_table->order('id desc')->where(array('status' => '1','type'=>'3'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }
    public function page($id){
         $picture_table = M('picture');
         $row=$picture_table->find($id);
         $this->assign('row',$row);
         $this->display();
    }

}

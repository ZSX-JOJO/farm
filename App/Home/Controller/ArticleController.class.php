<?php

namespace Home\Controller;

use Home\Controller\CommonController;

class ArticleController extends CommonController {

   
    public function newslist() {
        $article_table = M('article');
        $count = $article_table->where(array('art_status' => '1'))->count();
        $Page = new \Think\Page($count, 20);
        $show = $Page->show();
        $list = $article_table->order('art_time desc')->where(array('art_status' => '1','art_type'=>'1'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    
    public function articlezhang() {
        if (IS_GET) {

            $id = I('get.id', '', 'htmlspecialchars');
            $article_table = M('article');
            $relust = $article_table->where(array('id' => $id))->find();
            $this->assign('relust', $relust);
            $this->display();
        }
    }

    
    
    public function toziguizelist() {
        $article_table = M('article');
        $count = $article_table->where(array('art_status' => '1'))->count();
        $Page = new \Think\Page($count, 20);
        $show = $Page->show();
        $list = $article_table->order('art_time desc')->where(array('art_status' => '1','art_type'=>'2'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    
    public function touziguizepage() {
        if (IS_GET) {

            $id = I('get.id', '', 'htmlspecialchars');
            $article_table = M('article');
            $relust = $article_table->where(array('id' => $id))->find();
            $this->assign('relust', $relust);
            $this->display();
        }
    }
}

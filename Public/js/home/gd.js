$(function(){ 
var page= 1; 
var i =5;//ÿ���ĸ�ͼƬ 
//���ҹ��� 
$(".next").click(function(){ //����¼� 
var v_wrap = $(this).parents(".scroll"); // ���ݵ�ǰ�����Ԫ�ػ�ȡ����Ԫ�� 
var v_show = v_wrap.find(".scroll_list"); //�ҵ���Ƶչʾ������ 
var v_cont = v_wrap.find(".box"); //�ҵ���Ƶչʾ�������Χ���� 
var v_width = v_cont.width(); 
var len = v_show.find("li").length; //�ҵ���ƵͼƬ���� 
var page_count = Math.ceil(len/i); //ֻҪ����������������ķ���ȡ��С������ 
if(!v_show.is(":animated")){ 
if(page == page_count){ 
v_show.animate({left:'0px'},"slow"); 
page =1; 
}else{ 
v_show.animate({left:'-='+v_width},"slow"); 
page++; 
} 
} 
}); 
//������� 
$(".prev").click(function(){ //����¼� 
var v_wrap = $(this).parents(".scroll"); // ���ݵ�ǰ�����Ԫ�ػ�ȡ����Ԫ�� 
var v_show = v_wrap.find(".scroll_list"); //�ҵ���Ƶչʾ������ 
var v_cont = v_wrap.find(".box"); //�ҵ���Ƶչʾ�������Χ���� 
var v_width = v_cont.width(); 
var len = v_show.find("li").length; //�ҵ���ƵͼƬ���� 
var page_count = Math.ceil(len/i); //ֻҪ����������������ķ���ȡ��С������ 
if(!v_show.is(":animated")){ 
if(page == 1){ 
v_show.animate({left:'-='+ v_width*(page_count-1)},"slow"); 
page =page_count; 
}else{ 
v_show.animate({left:'+='+ v_width},"slow"); 
page--; 
} 
} 
}); 
}); 
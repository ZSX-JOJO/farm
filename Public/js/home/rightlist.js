$(function(){


	$('#rightcenter .clickfriend').click(function(){	//
		if($('#friendflag').val()!='1'){
			$('#rightcenter').animate({width:'236px'});
			$('#friendflag').val('1');
		}else{
			$('#rightcenter').animate({width:'30px'});
			$('#friendflag').val('0');
		}
		 $.cookie('tooltype',null);
		 $.cookie("planttype",null);
		 $("#body").css("cursor","default"); 
	});
	

	
	$('#sortmenu span').each(function(){
		$(this).click(function(){
			$(this).css('background','#fff2d7').find('a').css('color','#897654');
			$(this).siblings().css('background','#3b1804').find('a').css('color','#a63900');
		});
	});
});
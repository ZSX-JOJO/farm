$(function () {

    $('#switch_qlogin').click(function () {
        $('#switch_login').removeClass("switch_btn_focus").addClass('switch_btn');
        $('#switch_qlogin').removeClass("switch_btn").addClass('switch_btn_focus');
        $('#switch_bottom').animate({left: '0px', width: '70px'});
        $('#qlogin').css('display', 'none');
        $('#web_qr_login').css('display', 'block');

    });
    $('#switch_login').click(function () {

        $('#switch_login').removeClass("switch_btn").addClass('switch_btn_focus');
        $('#switch_qlogin').removeClass("switch_btn_focus").addClass('switch_btn');
        $('#switch_bottom').animate({left: '154px', width: '70px'});

        $('#qlogin').css('display', 'block');
        $('#web_qr_login').css('display', 'none');
    });
    if (getParam("a") == '0')
    {
        $('#switch_login').trigger('click');
    }



});

function logintab() {
    scrollTo(0);
    $('#switch_qlogin').removeClass("switch_btn_focus").addClass('switch_btn');
    $('#switch_login').removeClass("switch_btn").addClass('switch_btn_focus');
    $('#switch_bottom').animate({left: '154px', width: '96px'});
    $('#qlogin').css('display', 'none');
    $('#web_qr_login').css('display', 'block');

}

//根据参数名获得该参数 pname等于想要的参数名 
function getParam(pname) {
    var params = location.search.substr(1); // 获取参数 平且去掉？ 
    var ArrParam = params.split('&');
    if (ArrParam.length == 1) {
        //只有一个参数的情况 
        return params.split('=')[1];
    } else {
        //多个参数参数的情况 
        for (var i = 0; i < ArrParam.length; i++) {
            if (ArrParam[i].split('=')[0] == pname) {
                return ArrParam[i].split('=')[1];
            }
        }
    }
}
function username() {
    var username = $('#username').val();
    if (username == "") {

        $('#username_tip').html("<font color='red'><b>×账号不能为空</b></font>");
        return false;
    } else {
        if ($('#username').val().length < 6 || $('#username').val().length > 12) {
            $('#username_tip').html("<font color='red'><b>×账号在6-12字符</b></font>");
            return false;
        } else {

            $('#username_tip').html("");
            return true;
        }
    }

}

function password() {
    var password = $('#password').val();
    if (password == "") {
        $('#password_tip').html("<font color='red'><b>×密码不能为空</b></font>");
        return false;
    } else {
        if ($('#password').val().length < 6 || $('#password').val().length > 12) {
            $('#password_tip').html("<font color='red'><b>×密码在6-12字符</b></font>");
            return false;
        } else {
            $('#password_tip').html("");
            return true;
        }
    }

}

function recommend() {

    var recommend = $('#recommend').val();
    if (recommend == "") {
        $('#recommend_tip').html("<font color='red'><b>×直推人账号不能为空</b></font>");
        return false;
    } else {
        if ($('#recommend').val().length < 6 || $('#recommend').val().length > 12) {
            $('#recommend_tip').html("<font color='red'><b>×账号在6-12字符</b></font>");
            return false;
        } else {
            $.ajax({
                type: "post",
                url: "/Home/Login/check_recommend",
                data: {recommend: recommend},
                dataType: 'json',
                async: false, //设置为同步操作就可以给全局变量赋值成功 
                success: function (data) {
                    if (data.status == 1) {
                        flag= true;$('#recommend_tip').html("<font color='green'><b>" + data.msg + "</b></font>");
                    } else {
                        flag = false; $('#recommend_tip').html("<font color='red'><b>" + data.msg + "</b></font>");

                    }
                   
                }
            });

            return flag;
        }
    }
}
function user() {

    var user = $('#user').val();
    if (user == "") {
        $('#user_tip').html("<font color='red'><b>×手机号码不能为空</b></font>");
        return false;
    } else {
        reg = /^(1)[0-9]{10}$/;
        if (!reg.test(user)) {
            $('#user_tip').html("<font color='red'><b>×手机号码格式不对</b></font>");
            return false;
        } else {
            
            $.ajax({
                type: "post",
                url: "/Home/Login/check_mobiles",
                data: {mobile: user},
                dataType: 'json',
                async: false, //设置为同步操作就可以给全局变量赋值成功 
                success: function (data) {
                    if (data.status == 1) {
                        flag= true;$('#user_tip').html("<font color='green'><b>" + data.msg + "</b></font>");
                    } else {
                        flag = false; $('#user_tip').html("<font color='red'><b>" + data.msg + "</b></font>");

                    }
                   
                }
            });

            return flag;
        }
    }
}
function name() {

    var name = $('#name').val();
    if (name == "") {
        $('#name_tip').html("<font color='red'><b>×会员昵称不能为空</b></font>");
        return false;
    } else {
        if ($('#name').val().length < 2 || $('#name').val().length > 12) {
            $('#name_tip').html("<font color='red'><b>×会员昵称在2-12字符</b></font>");
            return false;
        } else {
            $('#name_tip').html("");
            return true;
        }
    }
}

function passwd() {

    var passwd = $('#passwd').val();
    if (passwd == "") {
        $('#passwd_tip').html("<font color='red'><b>×登录密码不能为空</b></font>");
        return false;
    } else {
        if ($('#passwd').val().length < 6 || $('#passwd').val().length > 12) {
            $('#passwd_tip').html("<font color='red'><b>×登录密码在6-12字符</b></font>");
            return false;
        } else {
            $('#passwd_tip').html("");
            return true;
        }
    }

}

function passwd2() {
    var passwd = $('#passwd').val();
    var passwd2 = $('#passwd2').val();
    if (passwd2 == "") {
        $('#passwd2_tip').html("<font color='red'><b>×确认密码不能为空</b></font>");
        return false;
    } else {
        if (passwd !== passwd2) {
            $('#passwd2_tip').html("<font color='red'><b>×两次密码不一致</b></font>");
            return false;
        } else {
            $('#passwd2_tip').html("");
            return true;
        }
    }
}

function code2() {
    var code2 = $('#code2').val();
    if (code2 == "") {
        $('#code2_tip').html("<font color='red'><b>×短信验证码不能为空</b></font>");
        return false;
    } else {
        if ($('#code2').val().length != 4) {
            $('#code2_tip').html("<font color='red'><b>×请输入4位数的短信验证码</b></font>");
            return false;
        } else {
            $('#code2_tip').html("");
            return true;
        }
    }
}
function code() {


    var code = $('#code').val();
    if (code == "") {
        $('#code_tip').html("<font color='red'><b>×验证码不能为空</b></font>");
        return false;
    } else {
        if ($('#code').val().length != 4) {
            $('#code_tip').html("<font color='red'><b>×请输入4位数的验证码</b></font>");
            return false;
        } else {
            $('#code_tip').html("");
            return true;
        }
    }
}

$(document).ready(function () {

    $('#username').blur(function () {
        username();
    });
    $('#password').blur(function () {
        password();
    });
    $('#code').blur(function () {
        code();
    });
    $('#login').click(function () {

        var usernames = username();
        var passwords = password();
        var codes = code();
        if (usernames && passwords && codes) {
            var username1 = $("#username").val();
            var password1 = $("#password").val();
            var code1 = $("#code").val();


            $.post('/Home/Login/ajax_login', {username: username1, password: password1, code: code1},
                    function (data) {
                        if (data.status == 1) {
                            $('#username_tip').html('');
                            $('#password_tip').html('');
                            $('#code_tip').html('');
                            location.href = data.url;
                        } else {
                            if (data.type == 1) {
                                $("#codeimg").attr('src', "/Home/Login/code?d='+Math.random();");
                                $('#username_tip').html("<font color='red'><b>×" + data.msg + "</b></font>");
                            } else if (data.type == 2) {
                                $("#codeimg").attr('src', "/Home/Login/code?d='+Math.random();");
                                $('#password_tip').html("<font color='red'><b>×" + data.msg + "</b></font>");

                            } else if (data.type == 3) {
                                $("#codeimg").attr('src', "/Home/Login/code?d='+Math.random();");
                                $("#code_tip").html("<font color='red'><b>×" + data.msg + "</b></font>");
                            }

                        }
                    }, "json");
        }
    });


    $('#recommend').blur(function () {
        recommend();
    });
    $('#user').blur(function () {
        user();
    });
    $('#name').blur(function () {
        name();
    });
    $('#passwd').blur(function () {
        passwd();
    });
    $('#passwd2').blur(function () {
        passwd2();
    });
    $('#code2').blur(function () {
        code2();
    });

    $('#reg').click(function () {
        var recommends = recommend();
        var users = user();
        var names = name();
        var passwds = passwd();
        var passwd2s = passwd2();
        var code2s = code2();
        if (recommends && users && passwds && passwd2s && code2s) {
            var recommend1 = $("#recommend").val();
            var user1 = $("#user").val();
            var name1 = $("#name").val();
            var passwd1 = $("#passwd").val();
            var code21 = $("#code2").val();
            $.post('/Home/Reg/reg', {recommend: recommend1, username: user1, password: passwd1, codes: code21, name: name1},
                    function (data) {
                        if (data.status == 1) {
                            $('#recommend_tip').html('');
                            $('#user_tip').html('');
                            $('#passwd_tip').html('');
                            $('#passwd2_tip').html('');
                            $('#code2_tip').html('');
                            layer.msg(data.msg, {icon: 1, time: 1500}, function () {
                                location.replace(location.href);
                            });
                        } else {
                            layer.msg(data.msg, {icon: 2, time: 1500}, function () {

                            });

                        }
                    }, "json");
        }

    });

    //获取短信验证码
    var validCode = true;
    $(".msgs").click(function () {

        var flag1 = user();
        var flag2=recommend();
        if (flag1&&flag2) {
            var time = 60 * 3;
            var code = $(this);
            var flag = false;
            if (validCode) {
                validCode = false;
                code.addClass("msgs1");
                flag = true;
                var t = setInterval(function () {
                    time--;
                    code.html(time + "秒");
                    if (time == 0) {
                        clearInterval(t);
                        code.html("重新获取");
                        validCode = true;
                        code.removeClass("msgs1");

                    }
                }, 1000)
            }
            if (flag)
            {
                flag = false;
                mobile = $('#user').val();
                findpwdcode(mobile);
            }

        } else
        {
            $('#code2_tip').html(' ');
            $('#passwd2_tip').html(' ');
            $('#passwd_tip').html(' ');
        }



    })


});
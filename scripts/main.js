$(function() {
    $('#slider').nivoSlider({ //banner
        directionNav: true,
        captionOpacity: 0.4,
        controlNav: true,
        boxCols: 8,
        boxRows: 4,
        slices: 15,
        effect: 'random',
        animSpeed: 500,
        pauseTime: 3000
    });
})


$(function() {

    $(function() { //右侧固定栏目
        $('.tel-mode').mouseover(function() { //电话咨询
            $('.tel-mode-show').show();
        }).mouseout(function() {
            $('.tel-mode-show').hide();
        });

        $('.back-mode').click(function() { //返回顶部
            $(window).scrollTop(0);
        })
    });

    $('.case-list-items').click(function() {
        $('.case-list-items').removeClass('on');
        $(this).addClass('on');
        var indexVal = $(this).index();
        if (0 === indexVal) { //推荐t-items
            $('.t-items').show();
            $('.g-items').hide();
            $('.f-items').hide();
            $('.z-items').hide();
        } else if (1 === indexVal) { //官网g-items
            $('.t-items').hide();
            $('.g-items').show();
            $('.f-items').hide();
            $('.z-items').hide();
        } else if (2 === indexVal) { //分销f-items
            $('.t-items').hide();
            $('.g-items').hide();
            $('.f-items').show();
            $('.z-items').hide();
        } else { //综合z-items
            $('.t-items').hide();
            $('.g-items').hide();
            $('.f-items').hide();
            $('.z-items').show();
        }
    })


    $('.sb-nav-items a').click(function() {
        $('.sb-nav-items a').removeClass('on');
        $(this).addClass('on');
    })



    $('.submit').click(function() { //提交留言

        var tagNames = $('.form-list').find('[name]');
        var stateVal = true;
        tagNames.each(function() {
            if ($(this).attr('name') === 'name') {
                //姓名
                if (!ischina($(this).val())) {
                    stateVal = false;
                    $(this).parent().find('.error-info').remove();
                    $(this).parent().append('<p class="error-info">请输入2-4位中文名！</p>');
                } else {
                    $(this).parent().find('.error-info').remove();
                }

            } else if ($(this).attr('name') === 'tel') {
                //电话
                if (!IsMob($(this).val())) {
                    stateVal = false;
                    $(this).parent().find('.error-info').remove();
                    $(this).parent().append('<p class="error-info">请输入合法的手机号码！</p>');
                } else {
                    $(this).parent().find('.error-info').remove();
                }

            } else if ($(this).attr('name') === 'email') {
                //邮箱
                if (!IsEmail($(this).val())) {
                    stateVal = false;
                    $(this).parent().find('.error-info').remove();
                    $(this).parent().append('<p class="error-info">请输入合法的邮箱地址！</p>');
                } else {
                    $(this).parent().find('.error-info').remove();
                }

            } else if ($(this).attr('name') === 'type') {
                //类型

            } else if ($(this).attr('name') === 'menoy') {
                //费用

                if ($(this).val() == '预算选择') {
                    stateVal = false;
                    $(this).parent().find('.error-info').remove();
                    $(this).parent().append('<p class="error-info">请选择费用预算！</p>');
                } else {
                    $(this).parent().find('.error-info').remove();
                }

            } else if ($(this).attr('name') === 'remark') {
                //备注
                if ($(this).val().length > 200) {
                    stateVal = false;
                    $(this).parent().find('.error-info').remove();
                    $(this).parent().append('<p class="error-info">输入字符不能超过200字！</p>');
                } else {
                    $(this).parent().find('.error-info').remove();
                }

            }
        })

        if (stateVal) {
            $('#myForm').submit();
        } else {
            return false;
        }

    });


    $('.ly').click(function() {
        $('#xglyNum').show();
    });

    $('.lr-nav-items').click(function() {
        var title = $(this).find('a').text();
        $('.lr-nav-items').removeClass('active');
        $(this).addClass('active');
        var indexTitle = $(this).index();
        $('.sb-r-title').text(title);
        for (var i = 1; i <= 6; i++) {
            if (indexTitle == i) {
                $('.set-mode' + i).show();
            } else {
                $('.set-mode' + i).hide();
            }
        }

    });

    $('.login-btn').click(function() {
            var selVal=$('.select-val').val();
            $.ajax({
                url: 'adminIndex.php',
                type: 'post',
                data: { messageNum: selVal},
                dataType: 'json',
                success: function() { 
                }
            }); 
            $('#messageNum').val(selVal);
            $('#xglyNum').hide();

    })


/*校验是否中文名称组成 */
function ischina(str) {
    var reg = /^[\u4E00-\u9FA5]{2,4}$/; /*定义验证表达式*/
    return reg.test(str); /*进行验证*/
}

/*校验邮件地址是否合法 */
function IsEmail(str) {
    var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
    return reg.test(str);
}

/*校验手机号码*/
function IsMob(str) {
    var reg = /^1(3|4|5|7|8)\d{9}$/;
    return reg.test(str);
}



/*修改登录账号、登录密码*/
    $('.account-mdy').click(function(){
            var iTop = ($(window).height() - 300) / 2;
            var iLeft = ($(window).width() - 400) / 2;
            $('.setting-mdy-content').css({
                top: iTop,
                left: iLeft,
            })
        $(window).resize(function() {
            var iTop = ($(window).height() - 300) / 2;
            var iLeft = ($(window).width() - 400) / 2;
            $('.setting-mdy-content').css({
                top: iTop,
                left: iLeft,
            })
        });
        $('.setting-mdy-mask').hide();
        $('#accountNumber').show();
        $('.close').click(function(){
            $('.setting-mdy-mask').hide();
        });
    })

    $('.password-mdy').click(function(){
         var iTop = ($(window).height() - 300) / 2;
            var iLeft = ($(window).width() - 400) / 2;
            $('.setting-mdy-content').css({
                top: iTop,
                left: iLeft,
            })
        $(window).resize(function() {
            var iTop = ($(window).height() - 300) / 2;
            var iLeft = ($(window).width() - 400) / 2;
            $('.setting-mdy-content').css({
                top: iTop,
                left: iLeft,
            })
        });
        $('.setting-mdy-mask').hide();
        $('#userPassword').show();
        $('.close').click(function(){
            $('.setting-mdy-mask').hide();
        });
    })


    $('.submitBtn').click(function(){
      var els=$(this).parent().parent().find('input');
      var oldPass=$('#old').val();
      var json={};
      var setStatue=true;
      els.each(function(){
        var name=$(this).attr('name');
        var nameVal=$(this).val();
        if(name=="password"){//原密码
              if(nameVal!=oldPass){
                $(this).next().text('原密码输入错误!');
                setStatue = false;
              }else{
                $(this).next().text('');
              }
          }

        if(name=="username"){//登录账号
              json["type"]='1';
              var reg=/^([a-zA-Z0-9]|[._]){5,30}$/; 
              if(!reg.test(nameVal)){
                $(this).next().text('账号输入6-30位字符!');
                setStatue = false;
              }else{
                $(this).next().text('');
              }
          }

        if(name=="password2"){//新密码
              json["type"]='2';
              var reg=/^(\w){6,24}$/;
              var newPass=$('#newPass').val(); 
              if(!reg.test(nameVal)){
                $(this).next().text('密码输入6-24位字符!');
                setStatue = false;
              }else{
                if(nameVal!=newPass){
                  $(this).next().text('重复密码输入不一致!');
                  setStatue = false;
                }else{
                  $(this).next().text('');
                }
              }
          }
        json[name]=nameVal;
      });

     if(setStatue){
            // $.ajax({
            //     url: 'adminIndex.php',
            //     type: 'post',
            //     data: json,
            //     dataType: 'json',
            //     success:function(data,status) {
            //         alert(status)
            //     },
            //     error:function(msg){
                   
            //     }
            // }); 
          $.post('adminIndex.php',json,function(){

            $('.setting-mdy-mask').hide();
            window.location.href='adminIndex.php'
          })

            
     }
    
    })
    /*修改登录账号、登录密码 end*/




})
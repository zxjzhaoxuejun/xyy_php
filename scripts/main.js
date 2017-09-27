$(function () {
    $('#slider').nivoSlider({//banner
        directionNav: true,
        captionOpacity: 0.4,
        controlNav: true,
        boxCols: 8,
        boxRows: 4,
        slices: 15,
        effect:'random',
        animSpeed: 500,
        pauseTime: 3000 });
})


$(function() {

    $(function() {//右侧固定栏目
        $('.tel-mode').mouseover(function() { //电话咨询
            $('.tel-mode-show').show();
        }).mouseout(function() {
            $('.tel-mode-show').hide();
        });

        $('.back-mode').click(function() { //返回顶部
            $(window).scrollTop(0);
        })
    });

    $('.case-list-items').click(function(){
        $('.case-list-items').removeClass('on');
        $(this).addClass('on');
        var indexVal=$(this).index();
        if(0===indexVal){//推荐t-items
           $('.t-items').show();
           $('.g-items').hide();
           $('.f-items').hide();
           $('.z-items').hide();
        }else if(1===indexVal){//官网g-items
           $('.t-items').hide();
           $('.g-items').show();
           $('.f-items').hide();
           $('.z-items').hide();
        }else if(2===indexVal){//分销f-items
           $('.t-items').hide();
           $('.g-items').hide();
           $('.f-items').show();
           $('.z-items').hide();
        }else{//综合z-items
            $('.t-items').hide();
           $('.g-items').hide();
           $('.f-items').hide();
           $('.z-items').show();
        }
    })


    $('.sb-nav-items a').click(function(){
        $('.sb-nav-items a').removeClass('on');
        $(this).addClass('on');
    })
    


    $('.submit').click(function(){//提交留言
    
      var tagNames=$('.form-list').find('[name]');
      var stateVal=true;
      tagNames.each(function(){
        if($(this).attr('name')==='name'){
        //姓名
           if(!ischina($(this).val())){
              stateVal=false;
              $(this).parent().find('.error-info').remove();
              $(this).parent().append('<p class="error-info">请输入2-4位中文名！</p>');
           }else{
              $(this).parent().find('.error-info').remove();
           }

        }else if($(this).attr('name')==='tel'){
          //电话
          if(!IsMob($(this).val())){
              stateVal=false;
              $(this).parent().find('.error-info').remove();
              $(this).parent().append('<p class="error-info">请输入合法的手机号码！</p>');
           }else{
              $(this).parent().find('.error-info').remove();
           }

        }else if($(this).attr('name')==='email'){
          //邮箱
          if(!IsEmail($(this).val())){
              stateVal=false;
              $(this).parent().find('.error-info').remove();
              $(this).parent().append('<p class="error-info">请输入合法的邮箱地址！</p>');
           }else{
              $(this).parent().find('.error-info').remove();
           }

        }else if($(this).attr('name')==='type'){
          //类型

        }else if($(this).attr('name')==='menoy'){
          //费用
  
          if($(this).val()=='预算选择'){
              stateVal=false;
              $(this).parent().find('.error-info').remove();
              $(this).parent().append('<p class="error-info">请选择费用预算！</p>');
           }else{
              $(this).parent().find('.error-info').remove();
           }

        }else if($(this).attr('name')==='remark'){
          //备注
          if($(this).val().length>200){
              stateVal=false;
              $(this).parent().find('.error-info').remove();
              $(this).parent().append('<p class="error-info">输入字符不能超过200字！</p>');
           }else{
              $(this).parent().find('.error-info').remove();
           }

        }
      })
      
      if(stateVal){
        $('#myForm').submit();
      }else{
        return false;
      }
       
    })


    /*校验是否中文名称组成 */
    function ischina(str) {
        var reg=/^[\u4E00-\u9FA5]{2,4}$/;   /*定义验证表达式*/
        return reg.test(str);     /*进行验证*/
    }

    /*校验邮件地址是否合法 */
    function IsEmail(str) {
        var reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        return reg.test(str);
    }

    /*校验手机号码*/
    function IsMob(str) {
        var reg=/^1(3|4|5|7|8)\d{9}$/;
        return reg.test(str);
    }



    
})


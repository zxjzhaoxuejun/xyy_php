<?php
  session_start();
//连接数据库
  include_once 'conn.php';
  
  $name = $_SESSION['LOGINNAME'];
  $id = $_SESSION['LOGINID'];
  $messageNum=$_POST['messageNum'];
  $user=$_POST['username'];
  $password=$_POST['password1'];
  $type=$_POST['type'];

  if($type){
    if($type==1){//账号
        $sq="update admin set admin_name='$user' where admin_id='$id'";
        mysql_query($sq);
    }
    else if($type==2){//密码
        $sq="update admin set admin_pass='$password' where admin_id='$id'";
        mysql_query($sq);
    }
  }

if(!$name) {
    header('Content-Type:text/plain;charset=utf-8');
    echo "403 Forbidden！请您先登录，然后在查看相关的信息！";
    die('//-^-\\');
    return flase;
  }else{
  //获取管理者名称
  $rs=mysql_query("select *from admin where admin_id=$id") or die(mysql_error());
  $rows=mysql_fetch_array($rs);
  }

function isNum($s) { 
    $patrn='/^(\d){1,5}$/'; 
    if (!preg_match($patrn,$s)) return false ;
    return true;
}
if(isNum($messageNum)){
  $sq="update admin set show_num='$messageNum' where admin_id='$id'";
  mysql_query($sq);
}

  

?>


<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>新友益</title>
    <link rel="stylesheet" href="content/main.css">
    <script src="scripts/jquery-1.11.3.min.js"></script>
    <script src="scripts/jquery.slider.pack.js"></script>
  </head>
  <body>
    <div class="header">
      <div class="header-con">
        <div class="sb-logo"><a href="adminIndex.php"><img src="content/images/1-1.png" alt="logo"></a></div>
        <div class="sb-nav" style="margin-left:0;">
          <ul class="sb-nav-list">
            <li class="sb-nav-items"><a href="adminIndex.php" class="on">首页</a></li>
            <li class="sb-nav-items"><a href="#tc">公司介绍</a></li>
            <li class="sb-nav-items"><a href="adminShow.php">留言信息</a></li>

          </ul>
        </div>
        <div class="username-mode"><?php if($user!=''){ echo $user;}else{echo $rows[admin_name];}?> <a href="admin.php" class="exit">退出</a></div>
        
      </div>
    </div>
    <div class="sb-content high-grey-bg">
      <div class="sb-lr-mode">
        <div class="sb-left-nav">
          <ul class="lr-nav-list">
            <li class="lr-nav-title">基本设置</li>
            <li class="lr-nav-items"><a href="#">轮播图</a></li>
            <li class="lr-nav-items"><a href="#">新闻动态</a></li>
            <li class="lr-nav-items"><a href="#">留言展示</a></li>
            <li class="lr-nav-items"><a href="#">公司信息</a></li>
            <li class="lr-nav-items"><a href="#">联系方式</a></li>
            <li class="lr-nav-items active"><a href="#">账户设置</a></li>
          </ul>
        </div>
        <div class="sb-right-content">
          <div class="sb-main-info">
            <div class="sb-r-title">账户设置</div>
            <div class="sb-info-list">
              
              <!-- 留言展示设置 -->
              <div class="set-mode3" style="display:none">
                <div class="list-row">
                <label class="list-row-name">展示留言数：</label>
                <input type="text" id="messageNum" class="input-val" style="width:60px;" disabled="disabled" value="<?php  if($messageNum==''||$messageNum=="请选择"){echo $rows[show_num];}else{echo $messageNum;}?>"> 条
                <span class="xg-mode ly">修改</span>
              </div>

              <div class="list-row" id="xglyNum">
                  <label class="list-row-name">修改展示留言数：</label>
                  <select class="select-val" name="messageNum">
                    <option>请选择</option>
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                    <option>30</option>
                    <option>50</option>
                  </select> 
                  <div class="list-row">
                    <button class="btn login-btn" style="width:30%;">确定</button>
                  </div>
                </div>
              </div>

              <!-- 账户设置 $rows-->
              <div class="set-mode6" style="display:block">
                <input type="hidden" value="<?php if($password!=''){ echo $password;}else{echo $rows[admin_pass];}?>" id="old" class="input-width">
                <div class="list-row">
                  <label class="list-row-name">账户：</label>
                  <input type="text" class="input-val" style="width:200px;" disabled="disabled" value="<?php if($user!=''){ echo $user;}else{echo $rows[admin_name];}?>">
                  <span class="xg-mode account-mdy">修改</span>
                </div>

                <div class="list-row">
                  <label class="list-row-name">密码：</label>
                  <input type="password" class="input-val" style="width:200px;" disabled="disabled" value="<?php  echo $rows[admin_pass];?>">
                  <span class="xg-mode password-mdy">修改</span>
                </div>

                <div id="userPassword" class="setting-mdy-mask">
      <div class="setting-mdy-bg"></div>
      <div class="setting-mdy-content">
        <div class="setting-mdy-title"><span class="title-text">修改登录密码</span><span class="close">X</span></div>
        <div class="setting-mdy-list"><span class="setting-text">原登录密码：</span>
          <input type="password" placeholder="请输入原登录密码" name="password" class="input-width">
          <p class="error-info"></p>
        </div>
        <div class="setting-mdy-list"><span class="setting-text">新登录密码：</span>
          <input type="password" placeholder="请输入新登录密码" id="newPass" name="password1" class="input-width">
          <p class="error-info"></p>
        </div>
        <div class="setting-mdy-list"><span class="setting-text">重复登录密码：</span>
          <input type="password" placeholder="请重复输入新登录密码" name="password2" class="input-width">
          <p class="error-info"></p>
        </div>
        <div class="setting-mdy-list qr_btn"><a href="javascript:;" class="btn green-bg-hover submitBtn">确认修改</a></div>
      </div>
    </div>
    <div id="accountNumber" class="setting-mdy-mask">
      <div class="setting-mdy-bg"></div>
      <div class="setting-mdy-content">
        <div class="setting-mdy-title"><span class="title-text">修改登录账号</span><span class="close">X</span></div>
        <div class="setting-mdy-list"><span class="setting-text">登录密码：</span>
          <input type="password" placeholder="请输入登录密码" name="password" class="input-width">
          <p class="error-info"></p>
        </div>
        <div class="setting-mdy-list"><span class="setting-text">新登录账号：</span>
          <input type="text" placeholder="请输入新登录账号" name="username" class="input-width">
          <p class="error-info"></p>
        </div>
        
        <div class="setting-mdy-list qr_btn"><a href="javascript:;" class="btn green-bg-hover submitBtn">确认修改</a></div>
      </div>
    </div>

              </div>

            </div>
          </div> 
        </div>
      </div>
      
    </div>
    <div class="footer">
      <div style="text-align:center;" class="footer-list1">
        <div class="footer-copy"><img src="content/images/logo_white.png">
          <div class="kh-text">客服专线：0755 - 83579842</div>
          <div class="copy-con">Copyright &copy 2014 - 2017深圳市新友益互联网有限公司<a href="#" class="icp"> 粤ICP备15027503号-1</a></div>
          <div class="addrr-con">地址：广东省深圳市龙华新区龙胜大厦</div>
        </div>
      </div>
    </div>
    
    <script src="scripts/main.js"></script>
  </body>
</html>
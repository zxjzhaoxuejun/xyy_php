<?php
session_start();
  //连接数据库
include_once 'conn.php';
$username=$_POST['username'];
$psd=$_POST['password'];


//校验登录名：只能输入5-30个字母、可带数字、“_”、“.”的字串 
function isRegisterUserName($s){ 
    $patrn='/^([a-zA-Z0-9]|[._]){5,30}$/'; 
    if (!preg_match($patrn, $s)) return false ;
    return true;
 };

// //校验用户姓名：只能输入1-30个以字母开头的字串 
// function isTrueName($s) { 
//     var patrn=/^[a-zA-Z]{1,30}$/; 
//     if (!patrn.exec($s)) return false ;
//     return true;
// } 

//校验密码：只能输入6-24个字母、数字、下划线 
function isPasswd($s) { 
    $patrn='/^(\w){6,24}$/'; 
    if (!preg_match($patrn,$s)) return false ;
    return true;
}
$statu=true;

if(!isRegisterUserName($username)){
  $usernameError="用户名输入错误!";
  $statu=false;
}else{
  $usernameError="";
}
if(!isPasswd($psd)){
   $passError="密码输入错误!";
  $statu=false;

}else{
  $passError="";
}


if($statu){//判断是否点击登录按钮
  //输入的用户名和密码
  $mname=base64_encode($username);
  mysql_query('set names utf8');
  $sql="select *from admin where admin_name='$username' and admin_pass='$psd'";
  $rs=mysql_query($sql);
  //获取结果集的记录数
  if(mysql_num_rows($rs)==1){
   $rows=mysql_fetch_array($rs);
    //echo '登录成功';
    
    $_SESSION['LOGINNAME']=$rows[admin_name];
    $_SESSION['LOGINID']=$rows[admin_id];
    header('location:adminIndex.php');
    }else{
      echo"<script>alert('登录失败');</script>";
  };
  
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>后台登录</title>
    <link rel="stylesheet" href="content/main.css">
    <script src="scripts/jquery-1.11.3.min.js"></script>

  </head>
  <body>
    <div class="header">
      <div class="header-con">
        <div class="sb-logo"><a href="admin.php"><img src="content/images/1-1.png" alt="logo"></a></div>
        <div class="sb-nav">
          <ul class="sb-nav-list">
            <li class="sb-nav-items"><a href="admin.php">后台登录</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="sb-content">
      <div class="login">
          <div class="login-title">深圳市新友益互联网有限公司</div>
          <form method="post">
             <div class="login-list">
               <label for="username">
                 账号：
               </label>
               <input type="text" name="username" placeholder="请输入5-30个字符" class="input-val">
               <p style="color:red;text-align:left;margin-left:120px;"><?php echo $usernameError;?></p>
             </div>
             <div class="login-list">
               <label for="password">
                 密码：
               </label>
               <input type="password" name="password" placeholder="请输入6-24位密码" class="input-val">
                <p style="color:red;text-align:left;margin-left:120px;"><?php echo $passError;?></p>
             </div>
             <button class="btn login-btn" type="submit">登录</button>
          </form>
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
    
  </body>
</html>
<?php
  session_start();
//连接数据库
  include_once 'conn.php';
  
  $name = $_SESSION['LOGINNAME'];
  $id = $_SESSION['LOGINID'];

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

  $messageNum=$_POST['messageNum'];

function isNum($s) { 
    $patrn='/^(\d){0,5}$/'; 
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
    <script src="scripts/jquery-1.6.min.js"></script>
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
        <div class="username-mode"><?php echo $rows[admin_name];?> <a href="admin.php" class="exit">退出</a></div>
        
      </div>
    </div>
    <div class="sb-content high-grey-bg">
      <div class="sb-lr-mode">
        <div class="sb-left-nav">
          <ul class="lr-nav-list">
            <li class="lr-nav-title">基本设置</li>
            <li class="lr-nav-items"><a href="#">轮播图</a></li>
            <li class="lr-nav-items"><a href="#">新闻动态</a></li>
            <li class="lr-nav-items active"><a href="#">留言展示</a></li>
            <li class="lr-nav-items"><a href="#">公司信息</a></li>
            <li class="lr-nav-items"><a href="#">联系方式</a></li>
            <li class="lr-nav-items"><a href="#">账户设置</a></li>
          </ul>
        </div>
        <div class="sb-right-content">
          <div class="sb-main-info">
            <div class="sb-r-title">留言展示</div>
            <div class="sb-info-list">
              <form method="post">
              <div class="list-row">
                <label class="list-row-name">展示留言数：</label>
                <select class="select-val" name="messageNum">
                <option>请选择</option>
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>30</option>
                <option>50</option>
              </select> 条
              </div>

              <div class="list-row">
                <button class="btn login-btn" style="width:30%;" type="submit">确定</button>
              </div>
            </form>
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
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
  }
  //获取管理者名称
  $rss=mysql_query("select *from admin where admin_id=$id") or die(mysql_error());
  $userRows=mysql_fetch_array($rss);

  $pageSize=$userRows[show_num];//每页显示记录数
  $rs=mysql_query("select count(*) from message_mode");
  $rows=mysql_fetch_array($rs);   //总记录数数组
  $totalnums=$rows[0];//总记录
  $pages=ceil($totalnums/$pageSize);//页面总数目
  
  

  //页面常量
  $page=1;

  // 删除记录
  if(isset($_GET['delId'])){
      $delId=$_GET['delId'];
      mysql_query("delete from message_mode where id=$delId") or die(mysql_error());
      if(mysql_affected_rows()==1){
        echo "<script>alert('删除成功!')</script>";
       }else{
        echo "<script>alert('删除成功!')</script>";
       }
  }
  
  
  //防止恶意翻页
  if($page>$pages){
    echo "<script>window.location.href='adminShow.php'</script>";
  }

  if(isset($_GET['page'])&&$_GET['page']!=0&&$_GET['page']<=$pages){
    $page=$_GET['page'];
    //当前页
    }else{
      $page=1;
    }//当前页
  if(isset($_POST['selectPage'])){
    $page=$_POST['selectPage'];
    };
  $offset=($page-1)*$pageSize;
  
  $sql="select *from message_mode order by id desc  limit $offset ,$pageSize";

  $rs=mysql_query($sql);
  //获取结果集的记录数
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
            <li class="sb-nav-items"><a href="adminIndex.php">首页</a></li>
            <li class="sb-nav-items"><a href="#tc">公司介绍</a></li>
            <li class="sb-nav-items"><a href="adminShow.php" class="on">留言信息</a></li>
          </ul>
        </div>
        <div class="username-mode"><?php echo $userRows[admin_name];?> <a href="admin.php" class="exit">退出</a></div>
      </div>
    </div>
    <div class="sb-content">
      <div class="show-list">
        <table style="width:100%;">
          <tr class="sb-row show-title">
             <td class="td-width-1">序号</td>
             <td class="td-width-1">姓名</td>
             <td class="td-width-2">手机号码</td>
             <td class="td-width-3">邮箱</td>
             <td class="td-width-2">建站类型</td>
             <td class="td-width-2">费用</td>
             <td class="td-width-4">备注</td>
             <td class="td-width-1">操作</td>
          </tr>
        
        <?php 
  //循环匹配的关联数组
  if($page==1){
    $num=1;
  }else{
  $num=($page-1)*$pageSize+1;
  }
  while($rows=mysql_fetch_assoc($rs)){
        echo '<tr class="sb-row">';
        echo '<td class="td-width-1">'.$num.'</td>';
        echo '<td class="td-width-1">'.$rows['message_name'].'</td>';
        echo '<td class="td-width-1">'.$rows['message_iphone'].'</td>';
        echo '<td class="td-width-1">'.$rows['message_email'].'</td>';
        echo '<td class="td-width-1">'.$rows['message_type'].'</td>';
        echo '<td class="td-width-1">'.$rows['message_menoy'].'</td>';
        echo '<td class="td-width-1">'.$rows['message_remark'].'</td>';
        echo '<td class="td-width-1"><a href=adminShow.php?delId='.$rows['id'].'>删除</a></td>';
        echo '</tr>';
    $num++;
    }
    echo "</table></div>";
  ?>
        
         <div class="sb-page-mode">
            <ul class="sb-page-list">
              <?php
              $next=$page+1;
              $pre=$page-1;
              if($next>$pages){
                $next=$pages;
              }
              echo '<li><a href=adminShow.php?page='.$pre.' class="sb-page-items pre-page">上一页</a></li>';
              
              for ($i=0;$i<$pages;$i++){
                if(($i+1)==$page){
                  echo "<li><a href=adminShow.php?page=".($i+1)." class=\"sb-page-items active\">".($i+1)."</a></li>";
                }else{
                  echo "<li><a href=adminShow.php?page=".($i+1)." class=\"sb-page-items\">".($i+1)."</a></li>";
                }
                
              }
              echo '<li><a href=adminShow.php?page='.$next.' class=\'sb-page-items next-page\'>下一页</a></li>';
              echo "<li>第 $page 页/ 共 $pages 页</li>";
            ?>
            </ul>
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
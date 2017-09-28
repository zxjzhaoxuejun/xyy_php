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


?>
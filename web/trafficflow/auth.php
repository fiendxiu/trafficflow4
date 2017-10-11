<?php

//登录  
if(!isset($_POST['submit'])){  
    exit('非法访问!');  
}

$username = htmlspecialchars($_POST['username']);  
$password = $_POST['password'];

$conn = mysql_connect("localhost", "root", "both-win") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());  
mysql_query("set names utf8"); 
$check_query = mysql_query("SELECT username FROM tf_user where username='{$username}' and password='$password'");
mysql_close($conn);
if($result = mysql_fetch_array($check_query)){  
    //登录成功  
    if($result['username']==="admin") {
        header("Location:admin_self.php");
    }
    else {
        session_start();  
        $_SESSION['username'] = $result['username'];  
        header("Location:aa.php");
    }
} else {  
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');  
} 

?>

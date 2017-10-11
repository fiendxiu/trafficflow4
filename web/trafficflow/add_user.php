
<?php
//增加用户
$cid=$_POST['cid'];
$usr=$_POST['username'];
$pwd=$_POST['password'];

$conn = mysql_connect("localhost", "root", "both-win") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());
mysql_query("set names utf8");

$check_query = mysql_query("SELECT username FROM tf_user where username='{$usr}'");
if($result = mysql_fetch_array($check_query)){
    //用户已存在
    mysql_close($conn);
    exit('帐号已存在，添加失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
} else {  
    $insert_user = "insert into tf_user (username,password,cid) values ('".$usr."','".$pwd."','".$cid."')";
    mysql_query($insert_user) or die("增加用户错误".mysql_error());
    mysql_close($conn);
    exit('用户帐号已添加！点击此处 <a href="javascript:history.back(-1);">返回</a> ');
} 

?>

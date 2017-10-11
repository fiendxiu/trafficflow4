
<?php
//查tf_link表全部信息
$conn = mysql_connect("localhost", "root", "") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());  
mysql_query("set names gb2312"); 
$select_query = mysql_query("SELECT * FROM tf_link");
while ($links = mysql_fetch_array($select_query)) {
  echo $links['description']." ".$links['link']." ".$links['username'];
  echo "<br />";
}
mysql_close($conn);
?>


<?php
//增加用户
$conn = mysql_connect("localhost", "root", "") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());
mysql_query("set names gb2312");
$insert_user = "insert into tf_user (username,password,cid) values ('test','test','9999')";
mysql_query($insert_user) or die("增加用户错误".mysql_error());
mysql_close($conn);
?>


<?php
//删除用户
$conn = mysql_connect("localhost", "root", "") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());
mysql_query("set names gb2312");
$delete_user = "delete from tf_user where username='test'";
mysql_query($delete_user) or die("删除用户错误".mysql_error());
mysql_close($conn);
?>

<?php
$conn = mysql_connect("localhost", "root", "") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());
mysql_query("set names gb2312");
$update_user = "update tf_user set password='test',cid='9999' where username='test'";
mysql_query($update_user) or die("更新用户错误".mysql_error());
mysql_close($conn);
?>

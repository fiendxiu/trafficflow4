
<?php
//增加流量图链接
$des=$_POST['description'];
$server=$_POST['server'];
$imageId=$_POST['imageId'];
$usr=$_POST['username'];

if($server == '1') {
    $link = 'http://mrtg.fnetlink.com.hk:10080/graph_image1.php?local_graph_id='.$imageId;
} else if ($server == '2') {
    $link = 'http://202.173.255.28:10080/cacti/graph_image1.php?local_graph_id='.$imageId;
} else if ($server == '3') {
    $link = 'http://mrtg3.fnetlink.com.hk:10080/graph_image1.php?local_graph_id='.$imageId;
} else {
    $link = $imageId;
}

$conn = mysql_connect("localhost", "root", "both-win") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());
mysql_query("set names utf8");

$insert_link = "insert into tf_link (description,link,username) values ('".$des."','".$link."','".$usr."')";
mysql_query($insert_link) or die("增加流量图形失败".mysql_error());
mysql_close($conn);
exit('流量图形已添加！点击此处 <a href="javascript:history.back(-1);">返回</a> ');

?>

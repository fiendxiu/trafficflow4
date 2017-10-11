<?php
include_once('connect.php');

$deleteUser = $_POST['del_username'];

$query_str = "delete from tf_user where username='".$deleteUser."'";
if (mysql_query($query_str)) {
  $arr=1;
} else {
  $arr=0;
}
echo json_encode($arr);
?>

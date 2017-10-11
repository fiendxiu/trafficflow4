<?php
include_once('connect.php');

$deleteNumber = $_POST['del_number'];

$query_str = "delete from tf_link where number=".$deleteNumber;
if (mysql_query($query_str)) {
  $arr=1;
} else {
  $arr=0;
}
echo json_encode($arr);
?>

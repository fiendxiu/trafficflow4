<?php
include_once('connect.php');

$page = intval($_POST['pageNum']);
$username = $_POST['userName'];

$result = mysql_query("select number from tf_link where username='{$username}'");
$total = mysql_num_rows($result);//总记录数

$pageSize = 20; //每页显示数
$totalPage = ceil($total/$pageSize); //总页数

$startPage = $page*$pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;
$query = mysql_query("select description,link from tf_link where username='{$username}' order by description asc limit $startPage,$pageSize");
while($row=mysql_fetch_array($query)){
         $arr['list'][] = array(
                'description' => $row['description'],
                'link' => $row['link'],
         );
}
//print_r($arr);
echo json_encode($arr);
?>


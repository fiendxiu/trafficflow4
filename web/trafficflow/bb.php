<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fnetlink Netmon</title>

<link href="css/home.css" rel="stylesheet" type="text/css" />
<script language="JavaScript"> 
function myrefresh() 
{ 
       window.location.reload(); 
} 
setTimeout('myrefresh()',300000); //指定5分钟刷新一次 
</script>
</head>

<body>
    <div id="subject">
    </div>
    <div id="myinfo">
      <h4> Fnetlink Netmon </h4>
      <h6>当前用户：<?php session_start();echo $_SESSION['username']; ?> <a href="index.html">(登出)</a></h6>
    </div>

      <div id="decorate">
      </div>
    <div id="image-show">
<div class='flow' >
<?php
$imagelink=$_POST['a'];
$tmp=$imagelink."&rra_id=1";
echo "<image src=$tmp></image>";
?>
<h4 class="label_desc">Daily (5 Minute Average)</h4>
</div>
<div class='flow' >
<?php
$tmp=$imagelink."&rra_id=2";
echo "<image src=$tmp></image>";
?>
<h4>Weekly (5 Minute Average)</h4>
</div>
<div class='flow' >
<?php
$tmp=$imagelink."&rra_id=3";
echo "<image src=$tmp></image>";
?>
<h4>Monthly (5 Minute Average)</h4>
</div>
<div class='flow' >
<?php
$tmp=$imagelink."&rra_id=4";
echo "<image src=$tmp></image>";
?>
<h4>Yearly (5 Minute Average)</h4>
</div>
    </div>
</body>

</html>

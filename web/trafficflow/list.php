
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="image/title.png">

    <title>Dashboard Template</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">

<script type="text/javascript">
function postwith(to, p) {
  var myForm = document.createElement("form");
  myForm.method = "post";
  myForm.action = to;
  for ( var k in p) {
    var myInput = document.createElement("input");
    myInput.setAttribute("name", k);
    myInput.setAttribute("value", p[k]);
    myForm.appendChild(myInput);
  }
  document.body.appendChild(myForm);
  myForm.submit();
  document.body.removeChild(myForm);
}
</script>

  </head>

  <body>

    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand">Fnetlink netmon</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="index.html">Home</a></li>
              </ul>
            </div>

          </div>
        </nav>

      </div>
    </div>

    <div class="container marketing">
      <div class="row">
        <div class="col-md-2 col-md-offset-2 sidebar">
          <h3 class="page-header">Traffic list</h3>
          <ul class="nav nav-sidebar">
<?php
session_start();
$username=$_SESSION['username'];
$conn = mysql_connect("localhost", "root", "") or die("数据库链接错误".mysql_error());
mysql_select_db("trafficflow",$conn) or die("数据库访问错误".mysql_error());
mysql_query("set names gb2312");
$select_query = mysql_query("SELECT description,link FROM tf_link where username='{$username}'");
mysql_close($conn);
while ($links = mysql_fetch_row($select_query)) {
  for ($i=0; $i<count($links); $i=$i+2) {
    echo "<li><a href=".'"javascript:postwith('."'list.php',{'a':'".$links[$i+1]."'})".'">'.$links[$i]."</a></li>";
  }
}
$imagelink=$_POST['a'];
?>
          </ul>
        </div>
        <div class="col-md-9 col-md-offset-4 main">
          <h3 class="page-header">Dashboard</h3>

          <div class="row placeholders">
            <div >
<?php
$tmp=$imagelink."&rra_id=1";
echo "<image src=$tmp></image>";
?>
              <h4 class="label_desc">Daily (5 Minute Average)</h4>
            </div>
            <div >
<?php
$tmp=$imagelink."&rra_id=2";
echo "<image src=$tmp></image>";
?>
              <h4>Weekly (5 Minute Average)</h4>
            </div>
            <div >
<?php
$tmp=$imagelink."&rra_id=3";
echo "<image src=$tmp></image>";
?>
              <h4>Monthly (5 Minute Average)</h4>
            </div>
            <div >
<?php
$tmp=$imagelink."&rra_id=4";
echo "<image src=$tmp></image>";
?>
              <h4>Yearly (5 Minute Average)</h4>
            </div>
          </div>

        </div>
      </div>

    </div><!-- /.container -->

  </body>
</html>


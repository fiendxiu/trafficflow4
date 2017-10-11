<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fnetlink Netmon</title>

<link href="css/home.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
var curPage = 1; //当前页码
var total,pageSize,totalPage;
//获取数据
function getData(page, user){
        $.ajax({
                type: 'POST',
                url: 'get_traffic_interfaces_menu.php',
                data: {'pageNum':page-1, 'userName':user},
                dataType:'json',
                beforeSend:function(){
                        $("#list ul").append("<li id='loading'>loading...</li>");
                },
                success:function(json){
                        $("#list table").empty();
                        total = json.total; //总记录数
                        pageSize = json.pageSize; //每页显示条数
                        curPage = page; //当前页
                        totalPage = json.totalPage; //总页数
                        var element = "<tr><th>图形标题</th></tr>";
                        var list = json.list;
                        $.each(list,function(index,array){ //遍历json数据列
                            if (index / 2 == 0) {
                                 element += "<tr><td id='colour1'><a href="+'"javascript:postwith('+"'bb.php',{'a':'"+array['link']+"'})"+'">'+array['description']+"</a></td></tr>";
                            }
                            else {
                                 element += "<tr><td id='colour2'><a href="+'"javascript:postwith('+"'bb.php',{'a':'"+array['link']+"'})"+'">'+array['description']+"</a></td></tr>";
                            }
                        });
                        $("#list table").append(element);
                },
                complete:function(){ //生成分页条
                        getPageBar();
                },
                error:function(){
                        alert("数据加载失败");
                }
        });
}

//获取分页条
function getPageBar(){
        //页码大于最大页数
        if(curPage>totalPage) curPage=totalPage;
        //页码小于1
        if(curPage<1) curPage=1;
        pageStr = "<span>共"+total+"条</span><span>"+curPage+"/"+totalPage+"</span>";

        //如果是第一页
        if(curPage==1){
                pageStr += "<span>首页</span><span>上一页</span>";
        }else{
                pageStr += "<span><a href='javascript:void(0)' rel='1'>首页</a></span><span><a href='javascript:void(0)' rel='"+(curPage-1)+"'>上一页</a></span>";
        }

        //如果是最后页
        if(curPage>=totalPage){
                pageStr += "<span>下一页</span><span>尾页</span>";
        }else{
                pageStr += "<span><a href='javascript:void(0)' rel='"+(parseInt(curPage)+1)+"'>下一页</a></span><span><a href='javascript:void(0)' rel='"+totalPage+"'>尾页</a></span>";
        }

        $("#pagecount").html(pageStr);
}

$(function(){
        <?php session_start();$abc=$_SESSION['username'];echo "var usr=\"$abc\""; ?> 
        getData(1, usr);
        $("#pagecount span a").live('click',function(){
                var rel = $(this).attr("rel");
                if(rel){
                        getData(rel, usr);
                }
        });
});
</script>
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
    <div id="subject">
    </div>
    <div id="myinfo">
      <h4> Fnetlink Netmon </h4>
      <h6>当前用户：<?php session_start();echo $_SESSION['username']; ?> <a href="index.html">(登出)</a></h6>
    </div>
    <div id="list">
      <div id="decorate"> </div>
        <table id="image_list" ></table>
    </div>
    <div id="pagecount"></div>

</body>

</html>

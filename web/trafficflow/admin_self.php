<!DOCTYPE html>
<html >
  <head>
    <link rel="icon" href="image/title.png">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>Fnetlink Netmon</title>
<style>
#pagecount{width:500px; margin:10px 2px; padding-bottom:20px;}
#pagecount span{margin:4px; font-size:14px}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
var curPage = 1; //当前页码
var total,pageSize,totalPage;
//获取数据
function getData(page){
        $.ajax({
                type: 'POST',
                url: 'pages.php',
                data: {'pageNum':page-1},
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
                        var element = "<tr><th>USER</th><th>DESCRIPTION</th><th>LINK</th></tr>";
                        var list = json.list;
                        $.each(list,function(index,array){ //遍历json数据列
                            element += "<tr><td>"+array['username']+"</td><td>"+array['description']+"</td><td>"+array['link']+"</td></tr>";
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

function del_link(number) {
    var r = confirm("确认删除吗？");
    if (r==true) {
       $.ajax({
           type: 'POST',
           url: 'del_link.php',
           data: {'del_number':number},
           dataType:'json',
           success:function(json){
               alert("已删除");
           },
           error:function(){
               alert("操作失败");
           }
       });
       location.reload();
    }
}

function del_user() {
    var r = confirm("确认删除吗？");
    var username = document.getElementById("del_u").value;
    if (r==true) {
       $.ajax({
           type: 'POST',
           url: 'del_user.php',
           data: {'del_username':username},
           dataType:'json',
           success:function(json){
               alert("已删除");
           },
           error:function(){
               alert("操作失败");
           }
       });
       location.reload();
    }
}

$(function(){
        getData(1);
        $("#pagecount span a").live('click',function(){
                var rel = $(this).attr("rel");
                if(rel){
                        getData(rel);
                }
        });

        $("#select").click(function() {
            var str = $("#select_desc").val();
            $.ajax({
                type: 'POST',
                url: 'dixon_pages.php',
                data: {'select_str':str},
                dataType:'json',
                success:function(json){
                        $("#list table").empty();
                        var element = "<tr><th>USER</th><th>DESCRIPTION</th><th>LINK</th><th>OPTIONS</th></tr>";
                        var list = json.list;
                        $.each(list,function(index,array){ //遍历json数据列
                            element += "<tr><td>"+array['username']+"</td><td>"+array['description']+"</td><td>"+array['link']+"</td><td><input type='button' onclick='del_link("+array['number']+")' style='margin:10px' value='删除'></td></tr>";
                        });
                        $("#list table").append(element);
                },
                error:function(){
                        alert("数据加载失败");
                }
            });
            $("#pagecount").hide();
        });
});
</script>

  </head>

  <body>

    <a href="index.html"><h4>返回主页</h4></a>

    <form action="add_user.php" method="POST">
      <h2> 添加用户帐号：</h2>
      <input type="text" name="cid" placeholder="CID" required=""  autofocus=""> 
      <input type="text" name="username" placeholder="帐号" required="">
      <input type="text" name="password" placeholder="密码" required="">
      <input name="submit" type="submit" value="添加">
    </form>

    <form action="del_user.php" method="POST">
      <h2> 删除用户帐号：</h2>
      <input id="del_u" type="text" name="del_username" placeholder="帐号" required="">
      <input type="button" onclick="del_user()" value="删除">
    </form>

    <form action="add_link2.php" method="POST">
      <h2> 添加流量图形：</h2>
      图形标题:<input type="text" name="description" placeholder="图形标题" required=""  autofocus="">
      SERVER:<input type="text" name="server" placeholder="SERVER" required="">
      图形ID:<input type="text" name="imageId" placeholder="图形ID" required="">
      用户名:<input type="text" name="username" placeholder="图形所属帐号" required="">
      <input name="submit" type="submit" value="添加">
    </form>

    <h2> 查询：</h2>
    <input id="select_desc" type="text" name="select_des" placeholder="接口描述" required=""  autofocus="">
    <input id="select" type="button" value="查询">

    <div id="list">
        <h2>数据库信息:</h2>
        <table border="1"></table>
    </div>
    <div id="pagecount"></div>

  </body>
</html>

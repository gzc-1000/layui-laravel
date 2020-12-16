<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>教师列表页</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include('admin.public.styles')
    @include('admin.public.script')
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" method="get" action="{{ url('admin/teacher') }}">
          <div class="layui-input-inline">
            <select name="num" lay-filter="aihao">
              {{--<option value=""></option>--}}
              <option value="5" @if($request->input('num')==5) selected    @endif>5</option>
              <option value="8" @if($request->input('num')==8) selected    @endif>8</option>
            </select>
          </div>
          {{--<input class="layui-input" placeholder="开始日" name="start" id="start">--}}
          {{--<input class="layui-input" placeholder="截止日" name="end" id="end">--}}
          <input type="text" name="queryname" value="{{ $request->input('queryname') }}"  placeholder="请输入名字" autocomplete="off" class="layui-input">
          <input type="text" name="dept"  value="{{ $request->input('dept') }}" placeholder="请输入专业" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','{{ url('admin/teacher/add') }}',600,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{ sizeof($teacher) }}条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>教师编号</th>
            <th>名字</th>
            <th>年龄</th>
            <th>性别</th>
            <th>专业</th>
            <th>工资</th>
            <!-- <th>状态</th> -->
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach($teacher as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $v->Tno }}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{ $v->Tno }}</td>
            <td>{{ $v->T_name }}</td>
            <td>{{ $v->age }}</td>
            <td>{{ $v->sex }}</td>
            <td>{{ $v->dept }}</td>
            <td>{{ $v->salary }}</td>          
            <!-- <td class="td-status">
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td> -->
            <td class="td-manage">
              <!-- <a onclick="member_stop(this,{{ $v->user_id }})" href="javascript:;" status="{{ $v->status }}"  title="启用">
                <i class="layui-icon">&#xe601;</i>
              </a> -->
              <!-- <a  href="{{ url('admin/user/auth/'.$v->user_id) }}"   title="授权">
                <i class="layui-icon">&#xe631;</i>
              </a> -->
              <a title="编辑"  onclick="x_admin_show('编辑','{{ url('/admin/teacher/edit?id='.$v->Tno) }}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              {{--<a onclick="x_admin_show('修改密码','member-password.html',600,400)" title="修改密码" href="javascript:;">--}}
                {{--<i class="layui-icon">&#xe631;</i>--}}
              {{--</a>--}}
              <a title="删除" onclick="member_del(this,{{ $v->Tno }})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
      <!-- 分页 -->
       {!! $teacher->appends($request->all())->render() !!}
      </div>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });
      /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){
              var status = $(obj).attr('data_id');
              $.get("/admin/user/changestate", { 'status': status,'userid':id},
                  function(data){
                      console.log($(obj).attr('data_id'));
                      if($(obj).attr('title')=='启用'){

                          //发异步把用户状态进行更改
                          $(obj).attr('title','停用')
                          $(obj).find('i').html('&#xe62f;');

                          $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                          layer.msg('已停用!',{icon: 5,time:1000});

                      }else{
                          $(obj).attr('title','启用')
                          $(obj).find('i').html('&#xe601;');

                          $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                          layer.msg('已启用!',{icon: 6,time:1000});
                      }
                  });
          });
      }


      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){

              $.get('/admin/teacher/destroy?id='+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
                  // console.log(data);
                  if(data.status == 0){
                      $(obj).parents("tr").remove();
                      layer.msg(data.message,{icon:6,time:1000});
                  }else{
                      layer.msg(data.message,{icon:5,time:1000});
                  }
              })

              //发异步删除数据

          });
      }



      function delAll (argument) {
          // 获取到要批量删除的用户的id
          var ids = [];

          $(".layui-form-checked").not('.header').each(function(i,v){
              var u = $(v).attr('data-id');
              ids.push(u);
          })


        layer.confirm('确认要删除吗？',function(index){

            $.get('/admin/teacher/del',{'ids':ids},function(data){
                if(data.status == 0){
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                    layer.msg(data.message,{icon:6,time:1000});
                }else{
                    layer.msg(data.message,{icon:5,time:1000});
                }
            });


        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>
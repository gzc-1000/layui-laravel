<!-- 顶部开始 -->
<div class="container">
        <div class="logo"><a href="./index.html">后台登录</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('资讯',#)"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
              <dd><a onclick="x_admin_show('图片',#)"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
               <dd><a onclick="x_admin_show('用户 最大化',#,'','',true)"><i class="iconfont">&#xe6b8;</i>用户最大化</a></dd>
               <dd><a onclick="x_admin_add_to_tab('在tab打开',#,true)"><i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
            </dl>
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">admin</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('个人信息', 'http://localhost:8088/admin/welcome')">个人信息</a></dd>
              <!-- <dd><a href="{{url('admin/welcome')}}">个人信息</a></dd> -->
              <dd><a href="{{ url('admin/logout') }}">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index" style="margin:0 20px 0">当前角色：管理员</li>
        </ul>
        
    </div>
<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台登录</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <script type="text/javascript"src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
    
    @include('admin.public.styles')
    @include('admin.public.script')
    
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body>
    <!-- 顶部开始 -->
    @include('admin.public.header')
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
    
@include('admin.public.aside')

    <!-- 右侧主体开始 -->
    <div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src="{{ url('admin/welcome') }}" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
</div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->

    @include('admin.public.footer')

</body>
</html>
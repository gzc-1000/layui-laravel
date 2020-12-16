<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>教师编号
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="Tno" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>您唯一的编号名
              </div>
          </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>名字
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="T_name" required="" lay-verify="nikename"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
    <label class="layui-form-label">
      <span class="x-red">*</span>性别
    </label>
    <div class="layui-input-inline" require> 
      <input type="radio" name="sex" value="男" title="男" checked>
      <input type="radio" name="sex" value="女" title="女">
    </div>
  </div>
        <!-- <div class="layui-form-item">
    <label class="layui-form-label">角色</label>
    <div class="layui-input-inline">
      <select name="role"  lay-verify="required" style="width:190px;">
        <option value="admin">管理员</option>
        <option value="student">学生</option>
        <option value="teacher">教师</option>
      </select>
    </div>
  </div> -->
        
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>年龄
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_pass" name="age"  required="" lay-verify="number"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red">*</span>专业
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_repass" name="dept" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red">*</span>工资
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_repass" name="salary" required="" lay-verify="number"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 3){
                return '昵称至少得3个字符啊';
              }
            }
            ,pass: [/(.+){4,12}$/, '密码必须4到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //监听提交
          form.on('submit(add)', function(data){

            //发异步，把数据提交给php
              $.ajax({
                  type:'POST',
                  url:'/admin/teacher/store',
                  dataType:'json',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data:data.field,
                  success:function(data){
                      // 弹层提示添加成功，并刷新父页面
                      // console.log(data);
                      if(data.status == 0){
                          layer.alert(data.message,{icon:6},function(){
                              parent.location.reload(true);
                          });
                      }else{
                          layer.alert(data.message,{icon:5});
                      }
                  },
                  error:function(){
                      //错误信息
                  }

              });





            // layer.alert("增加成功", {icon: 6},function () {
            //     // 获得frame索引
            //     var index = parent.layer.getFrameIndex(window.name);
            //     //关闭当前frame
            //     parent.layer.close(index);
            // });
            return false;
          });
          
          
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>
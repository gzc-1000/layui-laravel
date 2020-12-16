<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\Http\Controllers\Controller;

// 引用验证码文件后，终端运行composer dump-autoload进行加载
use App\Org\code\Code;
// 引入验证插件
use Gregwar\Captcha\CaptchaBuilder; 
use Gregwar\Captcha\PhraseBuilder;

use App\Model\User;
//crypt加密
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    //后台登录
    public function login() {
        return view('admin.login');
    }

    //生成验证码1
    // public function code() {
    //     $code = new Code();
    //     return $code -> make();
    // }
    
     // 验证码生成(使用验证码验证插件:packagist.org(composer插件安装网址))
     public function captcha($tmp)
     {
         $phrase = new PhraseBuilder;
         // 设置验证码位数
         $code = $phrase->build(4);
         // 生成验证码图片的Builder对象，配置相应属性
         $builder = new CaptchaBuilder($code, $phrase);
         // 设置背景颜色
         $builder->setBackgroundColor(220, 210, 230);
         $builder->setMaxAngle(25);
         $builder->setMaxBehindLines(0);
         $builder->setMaxFrontLines(0);
         // 可以设置图片宽高及字体
         $builder->build($width = 100, $height = 40, $font = null);
         // 获取验证码的内容
         $phrase = $builder->getPhrase();
         // 把内容存入session
         \Session::flash('code', $phrase);
         // 生成图片
         header("Cache-Control: no-cache, must-revalidate");
         header("Content-Type:image/jpeg");
         $builder->output();
     }

     //用户登录
     public function doLogin(Request $request) {
         // 1.接受表单提交的数据
         $input = $request -> except('_token');
         
         // 2.进行表单验证
        //   $validator = Validator::make('需要验证的表单数据','验证规则','错误提示信息')

        $rule = [
            'username'=>'required|between:2,18',
            'password'=>'required|between:2,18|alpha_dash',
        ];

        $msg = [
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名长度必须在2-18位',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码长度必须在2-18位',
            'password.alpha_dash'=>'密码必须是数字字母下划线',
        ];

        if ($request->isMethod('post')){
            // $validator = $this->validate($input, $rule);
          $validator = Validator::make($input, $rule, $msg);
        }
        
         if($validator->fails()) {
            //  bug:redirect返回不能用.， 用.只是将admin改为admin.login放在网页路径上
             return redirect('admin/login')
             ->withErrors($validator)
             ->withInput();
         }

         // 3.验证用户密码验证码(转小写操作)
          if(strtolower($input['code']) != strtolower(session() -> get('code'))){
            return redirect('admin/login') -> with('errors','验证码错误');
          }

        $user = User::where('user_name',$input['username']) -> first();
        
        if(!$user) {
            return redirect('admin/login') -> with('errors','用户名错误或不存在');
        }

        if($input['password'] != Crypt::decrypt($user->user_pass)){
            return redirect('admin/login') -> with('errors','密码错误');

        }

        // 4.保存用户信息到session
       session()->put('user',$user);

       // 5.跳转到后台首页 
       $role = $user->role;
    //    var_dump($role);
    if($role == 'admin'){
        return redirect('admin/index');
     }
    elseif($role == 'teacher') {
        return redirect('teacher/index');
    }elseif($role == 'student'){
        return redirect('student/index');
        }
        else{
            return redirect('admin/login') -> with('errors','用户角色不存在');
        };
       
    }

     //加密算法-----
     public function jisuan() {

        // 1.crypt加密
        //  $str = 1234;
        //  $c_str = Crypt::encrypt($str);
        //  return $c_str;
        // 1234 = eyJpdiI6IkkreWtMUmJhMVFKcEtFY2t4MjBPdFE9PSIsInZhbHVlIjoiSUdLcTBxd3ZNOXVlVGhtZzZ5RGZPQT09IiwibWFjIjoiMGNjMzZhNjY2OGMwNzE3ZDI4NzZhNWY3Y2VkMDQ1OGRkMDBjNzVlMWYxNmE1NzY2Y2RkNjhmYzZmM2Y0MGVkNiJ9

        //2.hash
        // $str = '1234';
        // return Hash::make($str);
        // Hash:check();
     }

     //后台首页
    public function index()
    {
        return view('admin.index');
    }

    // 教师
    public function tindex()
    {
        return view('teacher.index');
    }
    // 学生
    public function sindex()
    {
        return view('student.index');
    }

    //欢迎界面
    public function welcome()
    {
        return view('admin.welcome');
    }
    //退出登录
    public function logout()
    {
    //清空session中的用户信息
    session() -> flush();

        return redirect('admin/login');
    }

    //无权限对应的跳转页面
    public function noaccess(){
    return view('errors.noaccess');
    }

}

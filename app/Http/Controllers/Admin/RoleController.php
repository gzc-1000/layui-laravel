<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RoleController extends Controller
{
    //获取授权页面
    public function auth($id)
    {
    //获取当前角色
    $role = Role::find($id);

    //获取所有的权限列表
    $perms = Permission::get();

    //获取当前角色拥有的权限
   $own_perms = $role->permission;
   //角色拥有的权限的id
   $own_pers = [];
   foreach ($own_perms as $v) {
       $own_pers[] = $v->id;
   }

     return view('admin.role.auth',compact('role','perms','own_pers'));
    }

    //处理授权
    public function doAuth(Request $request) {
     $input = $request->except('_token');

     //删除当前角色已有的权限
    DB::table('role_permission')->where('role_id',$input['role_id'])->delete();
    //添加新授予的权限
    if(!empty($input['permission_id'])){
        foreach($input['permission_id']as $v) {
        DB::table('role_permission')->insert(['role_id'=>$input['role_id'],
        'permission_id'=>$v]);
    }
    }
    return redirect('admin/role');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //1.获取所有角色数据
        $role = Role::get();
        //2.返回视图
        return view('admin.role.list',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.获取表单提交数据
        $input = $request->except('_token');
        
        $role = $input['role_name'];

        //3.将数据添加到role表
        $res = Role::create(['role_name'=> $role]);

        if($res){
            $data = [
                'status'=>0,
                'message'=>'添加成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'添加失败'
            ];
        }
        // 效果：json_encode($data)
        return $data;
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //1.根据id获取要修改的记录
        $role = Role::find($id);
        //2.获取要修改的用户名
        $rolename = $request->input('role_name');

        $role->role_name = $rolename;
        $res = $role->save();

        if($res){
            $result = [
                'status' => '0',
                'msg'=> '修改成功'
            ];
        }else{
            $result = [
                'status' => '1',
                'msg'=> '修改失败'
            ];
        }
        return $result;
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //1.从数据库获取数据的id
        $role = Role::find($id);
        //2.删除
        $res = $role->delete();
        //3.返回信息
        if($res){
            $result = [
                'status' => '0',
                'msg'=> '删除成功'
            ];
        }else{
            $result = [
                'status' => '1',
                'msg'=> '删除失败'
            ];
        }
        return $result;
    
    }

     //删除所有选中用户
     public function delAll(Request $request)
     {
        $input = $request->input('ids');
 
       $res = Role::destroy($input);
       if($res) {
         $data = [
             'status' => '0',
             'message'=> '删除成功'
         ];
     }else {
         $data = [
             'status' => '1',
             'message'=> '删除失败'
         ];
     }
     return $data;
     }
 
}

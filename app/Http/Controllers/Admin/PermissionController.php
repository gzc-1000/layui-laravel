<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //1.获取所有权限
        $data = Permission::get();
        //2.返回参数到表单
        return view('admin.permission.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.获取输入的数据
        $input = $request->all();
        $permission_name = $input['permission_name'];
        $per_url = $input['per_url'];

        //2.在数据库创建('数据库字段名字'=>'表单中的name值')
         $res = Permission::create(['per_name'=>$permission_name,'per_url'=>$per_url]);
         
        //3.根据添加是否成功，给客户端返回一个json格式的反馈
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
        //1.找到要修改的id
        $per = Permission::find($id);

        return view('admin.permission.edit',compact('per'));
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
        //1.获取表单的数据
        $input = $request -> all();
        $pername = $input['per_name'];
        $perurl = $input['per_url'];
        //2.获取数据库数据
        $per = Permission::find($id);
        //3.更新
        $per->per_name = $pername;
        $per->per_url = $perurl;
        $res = $per -> save();
        //4.返回值
        if($res){
            $data = [
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'修改失败'
            ];
        }
        // 效果：json_encode($data)
        return $data;
    }
        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //1.找要删除的id
        $per = Permission::find($id);
        //2.从数据库删除
        $res = $per -> delete();
        //3.返回
        if($res){
            $data = [
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        // 效果：json_encode($data)
        return $data;
    
    }
    public function delAll(Request $request)
    {
       $input = $request->input('ids');

      $res = Permission::destroy($input);
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

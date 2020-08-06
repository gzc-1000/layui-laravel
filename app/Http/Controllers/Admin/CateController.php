<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateController extends Controller
{

    //修改排序的方法
    public function changeOrder(Request $request) {
    //1.获取传过来的id
    $input = $request-> except('_token');
    //2.通过分类id获取当前分类
    $cate = Cate::find($input['cate_id']);
    //3.修改当前分类的排序值
   $res =  $cate->update(['cate_order'=>$input['cate_order']]);
   if($res) {
    $data = [
        'status' => '0',
        'msg'=> '修改成功'
    ];
}else {
    $data = [
        'status' => '1',
        'msg'=> '修改失败'
    ];
}
return $data;

}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cates = Cate::get();
        
        $cates = (new Cate())->tree();
        return view('admin.cate.list',compact('cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::where('cate_pid',0)->get();
        return view('admin.cate.add',compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request ->except('_token');
        $catename = $input['cate_name'];
        $catetitle = $input['cate_title'];
        $cateorder = $input['cate_order'];

        $res = Cate::create(['cate_name'=>$catename,'cate_title'=>$catename,'cate_order'=>$cateorder]);
        if($res) {
            $data = [
                'status' => '0',
                'message'=> '添加成功'
            ];
        }else {
            $data = [
                'status' => '1',
                'message'=> '添加失败'
            ];
        }
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
        $cate = Cate::find($id);
        return view('admin.cate.edit',compact('cate'));
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
        $cate = Cate::find($id);
        $catename = $request->input('cate_name');
        $catetitle = $request->input('cate_title');

        $cate->cate_name = $catename;
        $cate->cate_title=$catetitle;
        $res = $cate -> save();

        if($res) {
            $data = [
                'status' => '0',
                'message'=> '添加成功'
            ];
        }else {
            $data = [
                'status' => '1',
                'message'=> '添加失败'
            ];
        }
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
        $cate = Cate::find($id);
        $res = $cate -> delete();
        if($res) {
            $data = [
                'status' => '0',
                'message'=> '添加成功'
            ];
        }else {
            $data = [
                'status' => '1',
                'message'=> '添加失败'
            ];
        }
        return $data;

    }
    //删除所有选中用户
    // public function delAll(Request $request)
    // {
    //    $input = $request->input('ids');

    //   $res = Cate::destroy($input);
    //   if($res) {
    //     $data = [
    //         'status' => '0',
    //         'message'=> '删除成功'
    //     ];
    // }else {
    //     $data = [
    //         'status' => '1',
    //         'message'=> '删除失败'
    //     ];
    // }
    // return $data;
    // }
}

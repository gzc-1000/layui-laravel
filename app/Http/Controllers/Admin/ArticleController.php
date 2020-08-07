<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Markdown;
//数据库缓存
use Redis;

class ArticleController extends Controller
{

    //将Markdown语法转换为HTML语法的内容
    public function pre_mk(Request $request){
    return Markdown::convertToHtml($request->cont);
    }


   //文件上传
    public function upload(Request $request) {
   //获取上传文件
     $file = $request->file('photo');
     //判断文件是否成功
    if(!$file->isValid()){
     return response()->json(['ServerNo'=>'400','ResultData'=>'无效的上传文件']);
    }
    //获取源文件的扩展名
    $ext = $file->getClientOriginalExtension();
    //生成新文件名
    $newfile = md5(time().rand(1000,9999)).'.'.$ext;
    //文件上传的指定路径
    $path = public_path('uploads');

    //将文件从临时目录移动到指定目录
    // if(!$file->move($path,$newfile)){
    //     return response()->json(['ServerNo'=>'400','ResultData'=>'保存文件失败']);
    // }
    // return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);

    //make:获取图片  resize:压缩图片
       $res = Image::make($file)->resize(100,100)->save($path.'/'.$newfile);

       if($res){
           // 如果上传成功
           return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);
       }else{
           return response()->json(['ServerNo'=>'400','ResultData'=>'上传文件失败']);
       }


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $arts = Article::get();
        // return view('admin.article.list',compact('arts'));
       
       
        //定义一个变量，存放所有的文章记录
        $arts = [];
//        $arts = Article::get();
        $listkey = 'LIST:ARTICLE';
        $hashkey = 'HASH:ARTICLE:';
//        redis中存在要取的文章
        if(Redis::exists($listkey)){
            //存放所有要获取文章的id
            $lists = Redis::lrange($listkey,0,-1);

            foreach ($lists as $k=>$v){
                $arts[] = Redis::hgetall($hashkey.$v);
            }

        }else{
//            1. 链接mysql数据库，获取需要的数据
            $arts = Article::get()->toArray();

//            2. 将数据存入redis
            foreach ($arts as $k=>$v){
                //将文章的id添加到listkey变量中
                Redis::rpush($listkey,$v['art_id']);
//                将文章添加到hashkey变量中
                Redis::hmset($hashkey.$v['art_id'],$v);
            }
//            3. 返回数据给客户端
        }

//        dd($arts);


        return view('admin.article.list',compact('arts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = (new Cate())->tree();
        return view('admin.article.add',compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $listkey = 'LIST:ARTICLE';
        $hashkey = 'HASH:ARTICLE:';

        $input = $request->except('_token','photo');
        //添加时间
        $input['art_time'] = time();
        $input['art_view'] = 0;
        $input['art_status'] = 0;

        // 将提交的文章数据保存到数据库

        $res = Article::create($input);

        if($res){
//            如果添加成功，更新redis
            \Redis::rpush($listkey,$res->art_id);
            \Redis::hMset($hashkey.$res->art_id,$res->toArray());

            return redirect('admin/article');
        }else{
            return back();
        }

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
        $cates = (new Cate)->tree();
        $arts = Article::find($id);
        return view('admin.article.edit',compact('arts','cates'));
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
        $input = $request->except('artid','_token','phote');
        $art = Article::find($id);
        $res = $art->update($input);
        
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
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
        $res = Article::find($id)->delete();
        //如果删除成功
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

        return $data;    }

      //添加推荐位
      public function recommend(Request $request)
      {
          // 更新添加到推荐位状态
          $input = $request->all();
  //        return $status;
          $art = Article::find($input['id']);
          if($input['status'] == 1){
              $res = $art->update(['art_status'=>0]);
              if($res){
                  return response()->json(['status' => 0]);
              }else{
                  return response()->json(['status' => 1]);
              }
          }else{
              $res = $art->update(['art_status'=>1]);
              if($res){
                  return response()->json(['status' => 0]);
              }else{
                  return response()->json(['status' => 1]);
              }
          }
  
  
      }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Model\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function tocourse(Request $request){
        //    $teacher = User::where('role','=','teacher')->get();
        
           $course = Course::orderBy('c_id','asc')
                        ->where(function($query) use($request){
                            $id = $request->input('id');
                            $name = $request->input('name');
                            $dec = $request->input('dec');                      
                            if(!empty($id)){
                                $query->where('c_id','like','%'.$id.'%'); 
                                // ->where('age','like','%'.$queryname.'%')->where('sex','like','%'.$queryname.'%')->where('dept','like','%'.$queryname.'%')->where('salary','like','%'.$queryname.'%')                   
                        }
                        if(!empty($name)){
                            $query->where('c_name','like','%'.$name.'%'); 
                    }
                    if(!empty($dec)){
                        $query->where('descript','like','%'.$dec.'%'); 
                }
                            })
                        ->paginate($request->input('num')?$request->input('num'):5);
           return view('admin.course.course',compact('course','request'));
       }

       public function coursetoadd(){
        return view('admin.course.add');
    }

    public function cou_store(Request $request)
       {
           $input = $request -> all();
           $c_id = $input['c_id'];
           $c_name = $input['c_name'];
           $point = $input['point']; 
           $start_time = $input['start_time']; 
           $end_time = $input['end_time']; 
           $dec = $input['dec'];

          $res = Course::create(['c_id'=>$c_id, 
                               'c_name'=>$c_name, 
                                'point'=>$point,
                             'descript'=>$dec,
                           'start_time'=>$start_time,
                             'end_time'=>$end_time]);
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
           return $data;
       }

       public function coursetoedit(Request $request)
       {
         $id = $request->input('id', '');
         $course = Course::find($id);
         $start_time = $course->start_time;
         $end_time = $course->end_time;
         return view('admin.course.edit',compact('course','start_time','end_time'));
         
       }
       public function cou_update(Request $request){
         $id = $request->input('id','');
         $course = Course::find($id);
     
         $c_name = $request->input('c_name');
         $point = $request->input('point');
         $start_time = $request->input('start_time');
         $end_time = $request->input('end_time');
         $descript = $request->input('dec');
     
         $course->c_name = $c_name;
         $course->point = $point;
         $course->start_time = $start_time;
         $course->end_time = $end_time;
         $course->descript = $descript;
         
         $res = $course->save();
     
         if($res){
             $data = [
                 'status' => '0',
                 'message'=> '修改成功'
             ];
         }else{
             $data = [
                 'status' => '1',
                 'message'=> '修改失败'
             ];
         }
         return $data;
     }
     public function cou_destroy(Request $request)
{  
    $id = $request->input('id','');
    $course = Course::find($id);
    $res = $course->delete();

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
public function delAll(Request $request)
{
   $input = $request->input('ids');

  $res = Course::destroy($input);
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

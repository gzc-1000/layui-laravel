<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teacher;
use DB;

class TeacherController extends Controller
{
    public function toteacher(Request $request){
        //    $teacher = User::where('role','=','teacher')->get();
        // $teacher = User::find(2)->teacher()->get();
        // $data = DB::table('article as a')->select('a.*','u.name')->join('users as u','a.user_id','=','u.id')->get();
        // /$teacher =  User::select('*')->with(['teacher'=>function($q){
        //     return $q->select('*');
        // }])
          
        $teacher = DB::table('teacher')->orderBy('Tno','asc')->where(function($query) use($request){
                            $queryname = $request->input('queryname');
                            $dept = $request->input('dept');                      
                            if(!empty($queryname)){
                                $query->where('T_name','like','%'.$queryname.'%'); 
                                // ->where('age','like','%'.$queryname.'%')->where('sex','like','%'.$queryname.'%')->where('dept','like','%'.$queryname.'%')->where('salary','like','%'.$queryname.'%')                   
                        }
                        if(!empty($dept)){
                            $query->where('dept','like','%'.$dept.'%'); 
                    }
                            })
                        ->paginate($request->input('num')?$request->input('num'):5);
           return view('admin.teacher.teacher',compact('teacher','request'));
       }

       public function teachertoadd(){
           return view('admin.teacher.add');
       }

       public function tea_store(Request $request)
       {
           $input = $request -> all();
           $Tno = $input['Tno'];
           $T_name = $input['T_name'];
           $sex = $input['sex']; 
           $age = $input['age']; 
           $dept = $input['dept']; 
           $salary = $input['salary']; 
          $res = Teacher::create(['Tno'=>$Tno, 
                               'T_name'=>$T_name, 
                                  'sex'=>$input['sex'], 
                                  'age'=>$input['age'],
                                 'dept'=>$input['dept'],
                               'salary'=>$input['salary']]);
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

     
    public function teachertoedit(Request $request)
  {
    $id = $request->input('id', '');
    $teacher = Teacher::find($id);
    return view('admin.teacher.edit',compact('teacher'));
    
  }

  public function tea_update(Request $request){
      $id = $request->input('id','');
      $teacher = Teacher::find($id);

      $T_name = $request->input('T_name');
      $sex = $request->input('sex');
      $age = $request->input('age');
      $dept = $request->input('dept');
      $salary = $request->input('salary');

      $teacher->T_name = $T_name;
      $teacher->sex = $sex;
      $teacher->age = $age;
      $teacher->dept = $dept;
      $teacher->salary = $salary;
      
      $res = $teacher->save();

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
  public function tea_destroy(Request $request)
  {  
      $id = $request->input('id','');
      $teacher = Teacher::find($id);
      $res = $teacher->delete();

      if($res) {
          $data = [
              'status' => '0',
              'message'=> '修改成功'
          ];
      }else {
          $data = [
              'status' => '1',
              'message'=> '修改失败'
          ];
      }
      return $data;
  }
  public function delAll(Request $request)
  {
     $input = $request->input('ids');

    $res = Teacher::destroy($input);
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

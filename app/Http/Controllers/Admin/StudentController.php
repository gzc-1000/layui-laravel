<?php

namespace App\Http\Controllers\Admin;

use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function tostudent(Request $request){
        //    $teacher = User::where('role','=','teacher')->get();
        
           $student = Student::orderBy('Sno','asc')
                        ->where(function($query) use($request){
                            $queryname = $request->input('queryname');
                            $class = $request->input('class');
                            $dept = $request->input('dept');                      
                            if(!empty($queryname)){
                                $query->where('name','like','%'.$queryname.'%'); 
                                // ->where('age','like','%'.$queryname.'%')->where('sex','like','%'.$queryname.'%')->where('dept','like','%'.$queryname.'%')->where('salary','like','%'.$queryname.'%')                   
                        }
                        if(!empty($dept)){
                            $query->where('dept','like','%'.$dept.'%'); 
                    }
                    if(!empty($class)){
                        $query->where('class','like','%'.$class.'%'); 
                }
                            })
                        ->paginate($request->input('num')?$request->input('num'):5);
           return view('admin.student.student',compact('student','request'));
       }

       public function studenttoadd(){
        return view('admin.student.add');
    }

    public function stu_store(Request $request)
       {
           $input = $request -> all();
           $Sno = $input['Sno'];
           $name = $input['name'];
           $sex = $input['sex']; 
           $age = $input['age']; 
           $dept = $input['dept']; 
           $class = $input['class']; 
          $res = Student::create(['Sno'=>$Sno, 
                                 'name'=>$name, 
                                  'sex'=>$input['sex'], 
                                  'age'=>$input['age'],
                                 'dept'=>$input['dept'],
                                'class'=>$input['class']]);
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
       public function studenttoedit(Request $request)
  {
    $id = $request->input('id', '');
    $student = Student::find($id);
    return view('admin.student.edit',compact('student'));
    
  }
  public function stu_update(Request $request){
    $id = $request->input('id','');
    $student = Student::find($id);

    $name = $request->input('name');
    $sex = $request->input('sex');
    $age = $request->input('age');
    $dept = $request->input('dept');
    $class = $request->input('class');

    $student->name = $name;
    $student->sex = $sex;
    $student->age = $age;
    $student->dept = $dept;
    $student->class = $class;
    
    $res = $student->save();

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
public function stu_destroy(Request $request)
{  
    $id = $request->input('id','');
    $student = Student::find($id);
    $res = $student->delete();

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

  $res = Student::destroy($input);
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

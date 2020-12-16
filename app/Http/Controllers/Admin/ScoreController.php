<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Score;
use App\Model\Student;
use DB;

class ScoreController extends Controller
{
    public function toscore(Request $request){
        $score = DB::table('score')->join('student', function($join){
            $join->on('score.stu_id','=','student.Sno');
          })->select('score.score_id','score.formal_score','score.end_score','student.Sno','student.name','student.class')
        ->orderBy('score.score_id','asc')
        ->where(function($query) use($request){
            $id = $request->input('id');
            $name = $request->input('name');
            $class = $request->input('class');                      
            if(!empty($id)){
                $query->where('student.Sno','like','%'.$id.'%'); 
                // ->where('age','like','%'.$queryname.'%')->where('sex','like','%'.$queryname.'%')->where('dept','like','%'.$queryname.'%')->where('salary','like','%'.$queryname.'%')                   
        }
        if(!empty($name)){
            $query->where('student.name','like','%'.$name.'%'); 
    }
    if(!empty($class)){
        $query->where('student.class','like','%'.$class.'%'); 
}
            })
        ->paginate($request->input('num')?$request->input('num'):5);
return view('admin.score.score',compact('score','request'));
}

public function scoretoadd(){
    return view('admin.score.add');
}

public function sco_store(Request $request)
{
    $input = $request -> all();
    $Sno = $input['Sno'];
    $name = $input['name'];
    $sex = $input['sex']; 
    $age = $input['age']; 
    $dept = $input['dept']; 
    $class = $input['class']; 
    $formal_score = $input['formal_score'];
    $end_score = $input['end_score'];
   $res = Student::create(['Sno'=>$Sno, 
                          'name'=>$name, 
                           'sex'=>$sex, 
                           'age'=>$age,
                          'dept'=>$dept,
                         'class'=>$class]);
     $res1 = Score::create(['stu_id'=>$Sno,
                      'formal_score'=>$formal_score,
                         'end_score'=>$end_score]);                    
    if($res && $res1){
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
public function scoretoedit(Request $request)
{
    $id = $request->input('id', '');
$student = Student::find($id);
$Sno = $student->Sno;
$score = Score::where('stu_id',$Sno)->first();
// $s = $score->formal_score;
//
    //   var_dump($s);
return view('admin.score.edit',compact('student','score'));

}
public function sco_update(Request $request){
$id = $request->input('id','');

$student = Student::find($id);
$Sno = $student->Sno;
$score = Score::where('stu_id',$Sno)->first();

$name = $request->input('name');
$sex = $request->input('sex');
$age = $request->input('age');
$dept = $request->input('dept');
$class = $request->input('class');
$formal_score = $request->input('formal_score');
$end_score = $request->input('end_score');

$student->name = $name;
$student->sex = $sex;
$student->age = $age;
$student->dept = $dept;
$student->class = $class;
$score->formal_score = $formal_score;
$score->end_score = $end_score;


$res = $student->save();
$res1= $score->save();

if($res && $res1){
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
public function sco_destroy(Request $request)
{  
$id = $request->input('id','');
$student = Student::find($id);
$Sno = $student->Sno;
$score = Score::where('stu_id',$Sno)->first();
$res = $student->delete();
$res1 = $score->delete();

if($res && $res1) {
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
// public function delAll(Request $request)
// {
// $input = $request->input('ids');

// $res = Student::destroy($input);
// if($res) {
// $data = [
//  'status' => '0',
//  'message'=> '删除成功'
// ];
// }else {
// $data = [
//  'status' => '1',
//  'message'=> '删除失败'
// ];
// }
// return $data;
// }
    
}

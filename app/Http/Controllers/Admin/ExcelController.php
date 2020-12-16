<?php

namespace App\Http\Controllers\Admin;

use App\Model\Student;
use App\Model\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use DB;

class ExcelController extends Controller
{
    // 气死人的死写法
//     public function export(){
//         // $score = DB::table('score')->join('student', function($join){
//         //     $join->on('score.stu_id','=','student.Sno');
//         //   })->select('score.score_id','score.formal_score','score.end_score','student.Sno','student.name','student.class');
        
//         // $student = Student::get();
//         // $stu_id = $student[0]->Sno;
//         // $score = Score::get()->where('stu_id',$stu_id);

//         $student = Student::get();
//         // $score = $student[1]->score->formal_score;
//         // var_dump($score);
//         // $id = $student->Sno;
//         // $name = $student->name;
//         // $age = $student->age;
//         $cellData = [
//             ['学号','名字','班级','平时成绩','期末成绩'],
//             [$student[0]->Sno, $student[0]->name, $student[0]->class,$student[0]->score->formal_score,$student[0]->score->end_score],
//             [$student[1]->Sno, $student[1]->name, $student[1]->class,$student[1]->score->formal_score,$student[1]->score->end_score],
//             [$student[2]->Sno, $student[2]->name, $student[2]->class,$student[2]->score->formal_score,$student[2]->score->end_score],
//             [$student[3]->Sno, $student[3]->name, $student[3]->class,$student[3]->score->formal_score,$student[3]->score->end_score],
//             [$student[4]->Sno, $student[4]->name, $student[4]->class,$student[4]->score->formal_score,$student[4]->score->end_score],
//             [$student[5]->Sno, $student[5]->name, $student[5]->class,$student[5]->score->formal_score,$student[5]->score->end_score],
//             [$student[6]->Sno, $student[6]->name, $student[6]->class,$student[6]->score->formal_score,$student[6]->score->end_score],
//             // [$student[7]->Sno, $student[7]->name, $student[7]->class,$student[7]->score->formal_score,$student[7]->score->end_score],
//             // [$student[8]->Sno, $student[8]->name, $student[8]->class,$student[8]->score->formal_score,$student[8]->score->end_score],
//             // [$student[9]->Sno, $student[9]->name, $student[9]->class,$student[9]->score->formal_score,$student[9]->score->end_score],
//             // [$student[10]->Sno, $student[10]->name, $student[10]->class,$student[10]->score->formal_score,$student[10]->score->end_score]
                    
//         ];
    
//         Excel::create('学生成绩',function($excel) use ($cellData){
//             $excel->sheet('score', function($sheet) use ($cellData){
//                 $sheet->rows($cellData);
//             });
//         })->export('xls');
//     }

function export(Excel $excel) {
    // $info = Score::select('stu_id','formal_score')->get();

        // $student = Student::get();
        // $info = $student[1]->score;

    $info =  DB::table('score')->join('student', function($join){
    $join->on('score.stu_id','=','student.Sno');
    })->select('score.score_id','score.formal_score','score.end_score','student.Sno','student.name','student.class')->get();
    // var_dump($info);
    foreach ($info as $key => $value) {
        $export[] = array(
            '学号' => $value->{'Sno'},
            '名字' => $value->{'name'},
            '班级' => $value->{'class'},
            '平时成绩' => $value->{'formal_score'},
            '期末成绩' => $value->{'end_score'},
        );
    }
    // var_dump($value->{'score_id'});
    Excel::create('学生成绩', function($excel) use ($export) {
        $excel->sheet('score', function($sheet) use ($export) {
            $sheet->fromArray($export);
        });
    })->export('xls');
}
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $primaryKey = 'Sno';

    //允许批量操作的数据
    // public $fillable = ['user_name','user_pass','email','phone'];
    //不允许的
    public $guarded = [];

    //是否维护created_at和update_at字段
    public $timestamps = false;

    public function score(){
        return $this->hasOne('App\Model\Score','stu_id','Sno');
    }
}

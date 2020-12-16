<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score';

    protected $primaryKey = 'score_id';

    //允许批量操作的数据
    // public $fillable = ['user_name','user_pass','email','phone'];
    //不允许的
    public $guarded = [];

    //是否维护created_at和update_at字段
    public $timestamps = false;

    public function student(){
        return $this->belongsToOne('App\Model\Student','Sno','stu_id');
    }
}

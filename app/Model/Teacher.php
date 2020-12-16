<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teacher';

    protected $primaryKey = 'Tno';

    //允许批量操作的数据
    // public $fillable = ['user_name','user_pass','email','phone'];
    //不允许的
    public $guarded = [];

    //是否维护created_at和update_at字段
    public $timestamps = false;

    public function user()
    {
        //关联的模型类名, 关系字段
        return $this->belongsTo('App\Model\Teacher', 'user_id', 'role_id');
    }
}

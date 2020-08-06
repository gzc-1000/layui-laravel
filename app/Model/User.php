<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'user_id';

    //允许批量操作的数据
    // public $fillable = ['user_name','user_pass','email','phone'];
    //不允许的
    public $guarded = [];

    //是否维护created_at和update_at字段
    public $timestamps = false;

     //跟Role的关联模型
     public function role()
     {
         return $this->belongsToMany('App\Model\Role','user_role','user_id','role_id');
     }
}

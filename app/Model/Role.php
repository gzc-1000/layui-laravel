<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = false;

    //添加动态属性，关联权限模型
    public function permission()
    {    
        // ('被关联的模型路径'，'数据库中的关联表名','数据库中的关联表要去关联的表的表名','数据库中的关联表被关联的表的表名')
        return $this->belongsToMany('App\Model\Permission','role_permission','role_id','permission_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_role extends Model
{
    use HasFactory;
    protected $table = 'group_role';
    protected $fillable = [
        'group_id' ,
        'role_id'
    ];
    public $timestamps = true;
    public function group() {
        return $this->belongsTo(Group::class,'group_id','id');
    }
    public function role() {
        return $this->belongsToMany(Role::class,'role_id','id');
    }
}

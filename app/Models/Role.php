<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'group_name'
    ];
    public $timestamps = true;
    public function group_role() {
        return $this->belongsTo(Group_role::class,'group_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    const ACTIVE = 0;
    const INACTIVE = 1;
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = [
        'name',
        'status'
    ];
    public $timestamps = true;
    public function product_tag() {
        return $this->hasMany(Product_tag::class,'product_id','id');
    }
}

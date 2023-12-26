<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_tag extends Model
{
    use HasFactory;
    protected $table = 'product_tag';
    protected $fillable = [
        'product_id',
        'tag_id'
    ];
    public $timestamps = true;
    public function product() {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function tag() {
        return $this->belongsToMany(Tag::class,'tag_id','id');
    }
}

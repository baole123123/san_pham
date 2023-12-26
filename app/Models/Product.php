<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price' ,
        'category_id' ,
        'status'
    ];
    public $timestamps = true;
    public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function product_tag() {
        return $this->belongsToMany(Product_tag::class,'product_id ','id');
    }
}

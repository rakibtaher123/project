<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cat_id', 'subcat_id', 'brand_id', 'unit_id', 'size_id', 'color_id', 'code', 'name', 'description', 'price', 'discount', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

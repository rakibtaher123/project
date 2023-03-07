<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cat_id', 'subcat_id', 'brand_id', 'unit_id', 'size_id', 'color_id', 'code', 'name', 'description', 'price', 'discount', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function catProductCount($id)
    {
        $catProductCount = Product::where('cat_id', $id)->where('status', 1)->count();
        return $catProductCount;
    }
    public static function subcatProductCount($id)
    {
        $subcatProductCount = Product::where('subcat_id', $id)->where('status', 1)->count();
        return $subcatProductCount;
    }
    public static function brandProductCount($id)
    {
        $brandProductCount = Product::where('brand_id', $id)->where('status', 1)->count();
        return $brandProductCount;
    }
}

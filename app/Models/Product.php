<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cat_id', 'subcat_id', 'brand_id', 'unit_id', 'size_id', 'color_id', 'code', 'name', 'description', 'price', 'discount', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcat_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class,'color_id');
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

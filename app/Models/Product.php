<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'brand',
        'price'
    ];

    public function user(){
        return $this->belongsTo();
    }

    public function category(){
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

    public function colors(){
        return $this->belongsToMany(Color::class, 'product_colors','product_id','color_id');
    }

    public function sizes(){
        return $this->belongsToMany(Size::class, 'product_sizes','product_id','size_id');
    }

    public function images(){
        return $this->belongsToMany(Image::class, 'product_images','product_id','image_id');
    }
}

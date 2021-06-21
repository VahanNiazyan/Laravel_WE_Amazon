<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

   protected $fillable = [];

   public function product(){
       return $this->hasMany(Product::class);
   }
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function children() {
        return $this->hasMany(Category::class, 'parent_id','id');
    }

}


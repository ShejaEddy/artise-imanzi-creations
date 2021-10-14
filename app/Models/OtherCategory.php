<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'title_image', 'bg_image', 'bg_image_direction'];

    public function products()
    {
        return $this->hasMany(Product::class, 'otherCategoryId');
    }
}

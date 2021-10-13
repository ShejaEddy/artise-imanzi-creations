<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'size', 'price', 'discount', 'shortDesc', 'longDesc', 'book_pdf', 'thumbnail', 'forwardImage', 'backwardImage', 'categoryId', 'otherCategoryId', 'stock', 'added_by', 'is_for_company', 'location', 'product_type', 'status'
    ];
}

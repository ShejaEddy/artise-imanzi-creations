<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveAway extends Model
{
    use HasFactory;
    protected $fillable = ['full_names', 'phone', 'product_id', 'sent'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

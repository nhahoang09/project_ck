<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPromotion extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'product_promotion';

    protected $fillable = [
        'product_id',
        'promotion_id',
    ];

    // Product_promotion to product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

  // Product_promotion to promotion
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id', 'id');
    }

    
}

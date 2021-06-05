<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'promotions';

    protected $fillable = [
        'name',
        'discount',
        'begin_date',
        'end_date',
        'status',
    ];

    public const STATUS = [
        0, // Private
        1, // Public
    ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
    public function productPromotion()
    {
        return $this->hasMany(ProductPromotion::class, 'promotion_id', 'id');
    }
}

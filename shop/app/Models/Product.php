<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'status',
        'quantity',
        'is_feature',
        'category_id',
    ];

    protected $hidden = [

    ];

    public const PAGE_LIMIT = 10;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function product_detail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }


    public function getPrice()
    {
        return $this->hasOne(Price::class)
            ->where('status',1)
            //->orwhere('price','desc')
            ->first();
    }

    public function getPromotion()
    {
        return $this->hasOne(Promotion::class)
            ->where('status',1)
            //->orwhere('discount','desc')
            ->first();
    }


}

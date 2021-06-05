<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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

    // public function promotions()
    // {
    //     return $this->hasMany(Promotion::class);
    // }


    public function getPrice()
    {
        $currentdate = date('Y-m-d');
        return $this->hasOne(Price::class)
            ->where('end_date', '>=', $currentdate)
            ->where('status',1)
            ->first();
    }

    // public function getPromotion()
    // {
    //     return $this->hasOne(Promotion::class)
    //         ->where('status',1)
    //         //->orwhere('discount','desc')
    //         ->first();
    // }
    // public function getPromotion() {
    //     return $this->belongsToMany(Promotion::class, 'product_promotion', 'product_id', 'promotion_id')
    //     // return $this->belongsToMany(ProductPromotion::class);
    //     ->first();
    // }

    public function productPromotion()
    {
        return $this->hasMany(ProductPromotion::class, 'product_id', 'id');
    }

    public function getPromotions() {

        return $this->belongsToMany(Promotion::class, 'product_promotion', 'product_id', 'promotion_id')
        ;
    }

    // public function getPromotionLatest($productId)
    // {
    //     Log::info('productID ' . $productId);
    //     // dd(1111);
    //     return $this->productPromotion()
    //     ->where('product_id', $productId)
    //     ->orderBy('created_at', 'desc')
    //     ->first();
    // }


    // chu y doan code nay nhe
    public function getPromotionLatest($productId)
    {
        return $this->hasOne(ProductPromotion::class, 'product_id', 'id')
            ->where('product_id', $productId)
             //->orderBy('created_at', 'desc')
            ;
    }


}

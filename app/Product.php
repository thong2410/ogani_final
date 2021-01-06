<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $dates = ['deleted_at'];
    protected $casts = [
        'detail' => 'object',
    ];
    
    protected $fillable = [
        'cate_id',
        'thumb_id',
        'prod_name',
        'unit_price',
        'unit',
        'sale',
        'hsd',
        'quantity',
        'status',
        'content',
        'detail',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    public function thumb()
    {
        return $this->hasOne(Media::class, 'id', 'thumb_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function wish()
    {
        return $this->hasMany(WishList::class, 'product_id');
    }

    public function wished($uid = null)
    {
        if(!$uid) $uid = Auth::id();

        return $this->wish()->where('wishlist.user_id', '=', $uid);
    }
    
    public function orders()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id')->orderBy('created_at', 'DESC');
    }
    
    public function agvRating(){
        return $this->hasMany(Review::class, 'product_id')
                    ->selectRaw('avg(rating) as star, product_id')
                    ->groupBy('product_id');
    }
}

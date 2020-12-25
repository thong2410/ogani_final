<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'product_reviews';
    protected $primaryKey = 'review_id';
    protected $fillable = ['user_id', 'product_id', 'content', 'rating'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function agvRating(){
        return $this->hasMany(Review::class, 'product_id')
                    ->selectRaw('avg(rating) as star, product_id')
                    ->groupBy('product_id');
    }
}

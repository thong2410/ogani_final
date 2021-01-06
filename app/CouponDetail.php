<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponDetail extends Model
{
    protected $primarykey = 'id';
    protected $fillable = [
    	'id',
    	'coupon_id',
    	'code',
    	'status',
    	'username',
    ];
    
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}

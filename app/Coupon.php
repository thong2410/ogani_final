<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $primaryKey = 'coupon_id';

    protected $fillable = [
    	'coupon_id',
    	'coupon_event',
    	'type',
    	'code',
    	'status',
    	'username',
    	'start_date',
    	'end_date',
    	'coupon_value'
    ];

    public function coupon_detail(){
        return $this->hasMany(CouponDetail::class, 'coupon_id');
    }
}

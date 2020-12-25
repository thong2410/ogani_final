<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    protected $table = 'orders';
    protected $primaryKey = 'order_id'; 
    protected $fillable = [
        'user_id', 
        'full_name',
        'phone_number',
        'order_email',
        'order_address',
        'order_address2',
        'order_Note',
        'order_status',
        'order_type'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

}

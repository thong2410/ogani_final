<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'user_address';
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'user_id', 
        'full_name',
        'phone_number',
        'order_email',
        'order_address',
        'order_address2'
    ]; 
}

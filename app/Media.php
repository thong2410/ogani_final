<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\WishList;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id';
    protected $fillable = [
        'path', 'name',
    ];    

    public function Product()
    {
        return $this->belongsTo(Product::class,'thumb_id');
    }

}

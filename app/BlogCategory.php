<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected $primaryKey = 'cate_id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'cate_id');
    }

    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}

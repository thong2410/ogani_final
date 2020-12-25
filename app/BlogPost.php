<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'blog_posts';
    protected $primaryKey = 'post_id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'cate_id',
        'thumb_id',
        'post_title',
        'post_content',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'cate_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'post_id');
    }

    public function thumb()
    {
        return $this->hasOne(Media::class, 'id', 'thumb_id');
    }
}

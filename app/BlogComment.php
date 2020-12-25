<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blog_comments';
    protected $primaryKey = 'comment_id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'post_id',
        'user_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
       
}

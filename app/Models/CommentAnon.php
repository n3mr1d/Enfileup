<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentAnon extends Model
{
    public $table = 'comment_anons';

    protected $fillable = [
        'username',
        'content',

        'commentable',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}

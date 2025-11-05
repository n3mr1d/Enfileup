<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class CommentAnon extends Model
{
    public $table = 'comment_anons';

    protected $fillable = [
        'username',
        'content',

        'commentable_id',
        'commentable_type'
    ];
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = Crypt::encryptString($value);
    }
    public function getContentAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}

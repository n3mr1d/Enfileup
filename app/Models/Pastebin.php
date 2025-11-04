<?php

namespace App\Models;

use App\Enum\ExpireTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Pastebin extends Model
{
    protected $table = 'pastebins';

    protected $fillable = [
        'title',
        'pastebin_id',
        'url_pastebin',
        'is_protected',
        'password',
        'expire_at',
        'view',
        'extension',
        'download',
    ];

    protected $casts = [
        'is_protected' => 'boolean',
        'expire_at' => 'datetime',
        'view' => 'integer',
        'download' => 'integer',
    ];

    public function incrementView()
    {
        return $this->increment('view');
    }

    public function incrementDownload()
    {
        return $this->increment('download');
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
            $this->attributes['is_protected'] = true;
        } else {
            $this->attributes['password'] = null;
            $this->attributes['is_protected'] = false;
        }
    }

    public function commentuser()
    {
        return $this->morphMany(CommentAnon::class, 'commentable');
    }
}

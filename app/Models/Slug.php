<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $fillable = [
        'uuid' => '',
        'uploadable_type',
        'uploadable_id',
        'token_del',
    ];

    public $timestamps = false;
    public function uploadable()
    {
        return $this->morphTo();
    }
}

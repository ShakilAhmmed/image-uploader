<?php

namespace ShakilAhmmed\ImageUploader\ImageProcessing\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'path',
        'user_id'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}

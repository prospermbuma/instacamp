<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
      protected $connection = 'mongodb';

    protected $table = 'comments';

    protected $fillable = [
        'comments',
        'user_id',
        'post_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(related: Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(related: Like::class);
    }
}

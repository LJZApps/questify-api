<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'text',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false; // Da wir die Timestamps manuell setzen

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_comment', 'post_id', 'comment_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->created_at = now();
        });
    }
}

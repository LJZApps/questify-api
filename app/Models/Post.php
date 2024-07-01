<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'text',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true; // Da wir die Timestamps manuell setzen

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($post) {
            $post->created_at = now();
            $post->updated_at = null;
        });
    }
}

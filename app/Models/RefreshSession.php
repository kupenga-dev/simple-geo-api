<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefreshSession extends Model
{
    protected $table = 'refresh_sessions';
    protected $fillable = [
        'user_id',
        'refresh_token',
        'ua',
        'fingerprint',
        'ip',
        'expires_in',
        'created_at'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

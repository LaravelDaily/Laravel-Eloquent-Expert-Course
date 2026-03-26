<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class PasswordResetToken extends Model
{
    use Prunable;

    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['email', 'token', 'created_at'];

    public function prunable(): Builder
    {
        return static::where('created_at', '<', now()->subDays(7));
    }
}

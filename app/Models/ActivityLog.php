<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use MassPrunable;

    protected $fillable = ['user_id', 'action'];

    public function prunable(): Builder
    {
        return static::where('created_at', '<', now()->subMonths(3));
    }
}

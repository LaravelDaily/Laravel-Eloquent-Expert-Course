<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Prunable, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'body'];

    public function prunable(): Builder
    {
        return static::onlyTrashed()->where('deleted_at', '<', now()->subDays(30));
    }
}

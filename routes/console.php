<?php

use App\Models\ActivityLog;
use App\Models\PasswordResetToken;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Prune all prunable models daily.
Schedule::command('model:prune')->daily();

// Prune specific models (for demonstration).
Schedule::command('model:prune', [
    '--model' => [PasswordResetToken::class, ActivityLog::class],
])->daily();

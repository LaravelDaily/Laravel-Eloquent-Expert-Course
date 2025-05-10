<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Scopes\VerifiedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Scope;

//#[ScopedBy([VerifiedScope::class])]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
//        static::addGlobalScope('verified', function (Builder $builder) {
//            $builder->whereNotNull('email_verified_at');
//        });

//        static::addGlobalScope(new VerifiedScope);
    }

    public function scopeVerified(Builder $query): void
    {
        $query->whereNotNull('email_verified_at');
    }

    // #[Scope]
    // protected function verified(Builder $query): void
    // {
    //     $query->whereNotNull('email_verified_at');
    // }

    public function scopeTypeOf(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }
}

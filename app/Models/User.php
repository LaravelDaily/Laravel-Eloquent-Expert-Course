<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'birth_date',
        'phone',
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

    protected function createdDiff(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->created_at->diffForHumans(),
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => ucfirst($value),
        );
    }

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y'),
            set: fn($value) => Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d'),
        );
    }

    public function networks(): HasMany
    {
        return $this->hasMany(Network::class);
    }

    public function ghosts(): HasMany
    {
        return $this->hasMany(Ghost::class);
    }

    protected function identity(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->is_full_identified()) {
                    return 1;
                }

                if ($this->is_ghost()) {
                    return 3;
                }

                return 0;
            },
        );
    }

    public function is_full_identified(): bool
    {
        return $this->networks->isNotEmpty() || (!is_null($this->name) && !is_null($this->phone));
    }

    public function is_ghost(): bool
    {
        return $this->ghosts->isNotEmpty() && is_null($this->email) && $this->networks->isEmpty();
    }
}

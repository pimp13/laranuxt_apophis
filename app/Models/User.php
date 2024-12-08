<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'is_active',
        'is_staff',
        'is_superuser',
        'user_activation_token',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'is_active' => 'boolean',
            'is_staff' => 'boolean',
            'is_superuser' => 'boolean',
        ];
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->first_name && $this->last_name) {
                    return "{$this->first_name} {$this->last_name}";
                } elseif ($this->first_name) {
                    return $this->first_name;
                } elseif ($this->last_name) {
                    return $this->last_name;
                } else {
                    return "ناشناس";
                }
            }
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }
}

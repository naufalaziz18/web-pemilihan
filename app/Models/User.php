<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi massal
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'has_voted',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom yang di-cast
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'has_voted' => 'boolean',
    ];

    /**
     * Relasi: User bisa punya banyak Vote
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}

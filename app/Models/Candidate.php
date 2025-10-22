<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'name',
        'vision',
        'mission',
        'photo',
    ];

    /**
     * Relasi: Kandidat bisa punya banyak vote
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}

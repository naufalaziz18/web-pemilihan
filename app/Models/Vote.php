<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',       // nullable, jika user login
        'candidate_id',  // wajib
        'identifier',    // string unik untuk guest
        'ip',            // optional: alamat IP voter
        'user_agent',    // optional: user agent browser
    ];

    /**
     * Relasi: Vote dimiliki oleh satu user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Vote dimiliki oleh satu kandidat
     */
    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }
}

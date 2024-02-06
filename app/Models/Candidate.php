<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'opt_1',
        'opt_2',
        'opt_3',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

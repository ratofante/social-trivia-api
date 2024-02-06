<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{

    protected $fillable = [
        'name'
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'category_question', 'category_id', 'question_id');
    }
}

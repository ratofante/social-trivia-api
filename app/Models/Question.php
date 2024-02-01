<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = [
        'question',
        'answer',
        'opt_1',
        'opt_2',
        'opt_3',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_question', 'question_id', 'category_id');
    }
}

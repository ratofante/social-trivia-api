<?php

namespace App\Repositories;

use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\DB;

class QuestionRepository extends BaseRepository
{
    public function create($attributes)
    {
        return DB::transaction(function() use($attributes) {
            dump('from Repository:' . data_get($attributes, 'user_id'));
            $created = Question::query()->create([
                "question" => data_get($attributes, 'question'),
                "answer" => data_get($attributes, 'answer'),
                "opt_1" => data_get($attributes, 'opt_1'),
                "opt_2" => data_get($attributes, 'opt_2'),
                "opt_3" => data_get($attributes, 'opt_3'),
                "user_id" => data_get($attributes, 'user_id')
            ]);
    
            return $created;
        });        
    }
    /**
     * @param Question $question
     * @param array $attributes
     * @return mixed
     */
    public function update($question, $attributes)
    {
        return DB::transaction(function() use ($question, $attributes) {
            $update = $question->update([
                "question" => data_get($attributes, 'question', $question->question),
                "answer" => data_get($attributes, 'answer', $question->answer),
                "opt_1" => data_get($attributes, 'opt_1', $question->opt_1),
                "opt_2" => data_get($attributes, 'opt_2', $question->opt_2),
                "opt_3" => data_get($attributes, 'opt_3', $question->opt_3),
                "user_id" => $question->user_id
            ]);

            if(!$update) {
                throw new Exception('Failed to update post');
            }

            return $question;
        });
    }
    /**
     * @param Post $question
     * @return mixed
     */
    public function forceDelete($question) {

        DB::transaction(function() use($question) {
            $deleted = $question->forceDelete();

            if(!$deleted) {
                throw new Exception('Failed to delete post');
            }

            return $deleted;
        });
    }
}
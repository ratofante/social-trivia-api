<?php

namespace Database\Seeders;

use App\Models\Question;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('questions');
        $this->truncate('category_question');

        $initial_questions = include(database_path('data/initial_questions.php'));

        foreach($initial_questions as $category => $categoryQuestions)
        {
            
                foreach($categoryQuestions as $key => $values)
                {
                    $question = Question::create([
                        "question" => $values['question'],
                        "answer" => $values['answer'],
                        "opt_1" => $values['opt_1'],
                        "opt_2" => $values['opt_2'],
                        "opt_3" => $values['opt_3']
                    ]);

                    DB::table('category_question')->insert([
                        'category_id' => $values['category_id'],
                        'question_id' => $question->id
                    ]);

                }
        }

        $this->enableForeignKeys();
    }
}

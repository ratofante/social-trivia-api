<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Should I return the question id and foreign user_id?
        return [
            "question" => $this->question,
            "answer" => $this->answer,
            "opt_1" => $this->opt_1,
            "opt_2" => $this->opt_2,
            "opt_3" => $this->opt_3,
            "user_id" => $this->user_id
        ];
    }
}
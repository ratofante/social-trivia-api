<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Repositories\QuestionRepository;
use Illuminate\Http\JsonResponse;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return ResourceCollection
     */
    public function index()
    {
        $questions = Question::query()->paginate(20);

        return QuestionResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request\StoreQuestionRequest $request
     * @return QuestionResource;
     */
    public function store(StoreQuestionRequest $request, QuestionRepository $repository)
{
    $validatedData = $request->validated();
    $created = $repository->create($validatedData);

    return new QuestionResource($created);
}

    /**
     * Display the specified resource.
     * @param \App\Models\Question $question
     * @return QuestionResource
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Model\Question $question
     * @param \App\Http\Requests\UpdateQuestionRequest $request
     * @return QuestionResource
     */
    public function update(UpdateQuestionRequest $request, Question $question, QuestionRepository $repository)
    {
        $question = $repository->update($question, $request->only([
            "question",
            "answer",
            "opt_1",
            "opt_2",
            "opt_3"
        ]));

        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question, QuestionRepository $repository)
    {
        $repository->forceDelete($question);

        return new JsonResponse([
            'message' => 'success'
        ]);
    }
}

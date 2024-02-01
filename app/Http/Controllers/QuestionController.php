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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request\StoreQuestionRequest $request
     * @return QuestionResource;
     */
    public function store(StoreQuestionRequest $request, QuestionRepository $repository)
{
    $validatedData = $request->validated();
    $created = $repository->create([
        "question" => $validatedData['question'],
        "answer" => $validatedData['answer'],
        "opt_1" => $validatedData['opt_1'],
        "opt_2" => $validatedData['opt_2'],
        "opt_3" => $validatedData['opt_3'],
        "user_id" => $validatedData['user_id']
    ]);

    return new QuestionResource($created);
}

    /**
     * Display the specified resource.
     */
    public function show(Question $question): JsonResponse
    {
        return new JsonResponse([
            'data' => Question::find($question)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question, QuestionRepository $repository)
    {
        // $validatedData = $request->validate();
        // dump($validatedData);

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
     */
    public function destroy(Question $question, QuestionRepository $repository)
    {
        $repository->forceDelete($question);

        return new JsonResponse([
            'message' => 'success'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserDeleted;
use App\Events\Models\User\UserUpdated;
use App\Models\User;
use Illumniate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return ResourceCollection
     */
    public function index()
    {
        $users = User::query()->paginate(20);
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request, UserRepository $repository)
    {
        $validated = $request->validated();
        $created = $repository->create($validated);

        event(new UserCreated($created));

        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Models\User $user
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, User $user, UserRepository $repository)
    {
        $user = $repository->update($user, $request->only([
            'name',
            'email',
            'password' 
        ]));
        event(new UserUpdated($user));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\User $user
     * @return JsonResponse
     */
    public function destroy(User $user, UserRepository $repository)
    {
        $repository->forceDelete($user);
        event(new UserDeleted($user));

        return new JsonResponse([
            'message' => 'success'
        ]);
    }
}

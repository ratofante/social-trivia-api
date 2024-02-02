<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function create(array $attributes) {

        return DB::transaction(function() use($attributes) {
            $created = User::query()->create([
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email'),
                'password' => data_get($attributes, 'password')
            ]);

            return $created;
        });
    }

    public function update($user, array $attributes) {
        
        return DB::transaction(function() use($user, $attributes) {
            $updated = $user->update([
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email),
                'password' => data_get($attributes, 'password', $user->password)
            ]);

            if(!$updated) {
                throw new Exception('Failed to update user');
            }

            return $user;
        });
    }

    public function forceDelete($user) {
        return DB::transaction(function() use($user) {
            $deleted = $user->forceDelete();

            if(!$deleted) {
                throw new Exception('Failed to delete user');
            }

            return $deleted;
        });
    }
}
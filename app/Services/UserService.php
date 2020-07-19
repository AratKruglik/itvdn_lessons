<?php

namespace App\Services;

use App\Http\Requests\EditUserRequest;
use App\User;
use \Exception;

class UserService
{
    /**
     * @param EditUserRequest $request
     * @param User $user
     */
    public function updateUser(EditUserRequest $request, User $user): void
    {
        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_admin' => $request->has('is_admin') ? $request->is_admin : false,
            'is_manager' => $request->has('is_manager') ? $request->is_manager : false,
        ]);
    }

    /**
     * @param User $user
     * @throws Exception
     */
    public function deleteUser(User $user): void
    {
        $user->delete();
    }
}
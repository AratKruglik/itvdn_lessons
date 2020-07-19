<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Services\UserService;
use App\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $users = User::paginate();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param EditUserRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(EditUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $this->userService->updateUser($request, $user);

        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(User $user): RedirectResponse
    {
       $this->userService->deleteUser($user);

        return redirect()->route('admin.users.index');
    }
}

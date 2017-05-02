<?php

namespace App\Http\Controllers;

use EntityManager;
use App\Http\Requests\UpdateProfileRequest;
use Auth;
use App\Repositories\UserRepositoryInterface;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    private $users;

    /**
     * Конструктор.
     *
     * @param  UserRepositoryInterface  $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;

        $this->middleware('auth');
    }

    /**
     * Отдаёт профиль.
     *
     * @return View
     */
    public function show()
    {
        $user = Auth::user();

        return view('profile.show', [
            'user' => $user,
        ]);
    }

    /**
     * Отдаёт профиль для редактирования.
     *
     * @return View
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Редактирует профиль.
     *
     * @param  UpdateProfileRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $userId = Auth::user()->getId();

        $user = $this->users->update([
            'name' => $request->input('name'),
        ], $userId);

        $this->users->save($user);

        return redirect('profile');
    }
}

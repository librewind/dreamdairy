<?php

namespace App\Http\Controllers;

use EntityManager;
use App\Http\Requests\UpdateProfileRequest;
use Auth;
use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Entities\User;

class ProfileController extends Controller
{
    /** @var UserRepository  */
    private $users;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
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
     *
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        $user = $this->users->update([
            'name' => $request->input('name'),
        ], $currentUser->getId());
        $this->users->save($user);

        return redirect('profile');
    }
}

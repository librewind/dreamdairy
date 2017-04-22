<?php

namespace App\Http\Controllers;

use EntityManager;
use App\Http\Requests\UpdateProfileRequest;
use Auth;
use App\Repositories\UserRepository;

class ProfileController extends Controller
{
    private $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;

        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();

        return view('profile.show', [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

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

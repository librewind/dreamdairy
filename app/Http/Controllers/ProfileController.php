<?php

namespace App\Http\Controllers;

use EntityManager;
use App\Http\Requests\UpdateProfileRequest;
use Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $user = Auth::user();

        $user->setName($request->input('name'));

        EntityManager::persist($user);

        EntityManager::flush();

        return redirect('profile');
    }
}

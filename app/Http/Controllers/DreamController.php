<?php

namespace App\Http\Controllers;

use EntityManager;
use App\Http\Requests\StoreDreamRequest;
use App\Repositories\DreamRepository;
use App\Repositories\UserRepository;
use App\Entities\Dream;

class DreamController extends Controller
{
    private $dreams;

    public function __construct(DreamRepository $dreams)
    {
        $this->dreams = $dreams;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dreams = $this->dreams->paginateAll(10);

        return view('dreams.index', [
            'dreams' => $dreams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dreams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDreamRequest $request, UserRepository $users)
    {
        $dream = new Dream([
            'title' => $request->input('title'),
            'body'  => $request->input('body'),
        ]);

        $user = $users->find($request->input('user_id'));

        $dream->setUser($user);

        EntityManager::persist($dream);

        EntityManager::flush();

        return redirect('dreams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dream = $this->dreams->find($id);

        return view('dreams.show', [
            'dream' => $dream,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dream = $this->dreams->find($id);

        return view('dreams.edit', [
            'dream' => $dream,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDreamRequest $request, $id)
    {
        $dream = $this->dreams->find($id);

        $dream->setTitle($request->input('title'));

        $dream->setBody($request->input('body'));

        EntityManager::persist($dream);

        EntityManager::flush();

        return redirect('dreams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dream = $this->dreams->find($id);

        EntityManager::remove($dream);

        EntityManager::flush();

        return redirect('dreams');
    }
}

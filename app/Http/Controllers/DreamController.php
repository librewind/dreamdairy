<?php

namespace App\Http\Controllers;

use EntityManager;
use App\Http\Requests\StoreDreamRequest;
use App\Repositories\DreamRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DreamController extends Controller
{
    private $dreams;

    /**
     * Конструктор.
     *
     * @param  DreamRepositoryInterface  $dreams
     * @return void
     */
    public function __construct(DreamRepositoryInterface $dreams)
    {
        $this->dreams = $dreams;

        $this->middleware('auth');
    }

    /**
     * Отдаёт все сны пользователя.
     *
     * @return View
     */
    public function index()
    {
        $userId = Auth::user()->getId();

        $dreams = $this->dreams->findAllByUserId($userId, 10);

        return view('dreams.index', [
            'dreams' => $dreams,
        ]);
    }

    /**
     * Отдаёт форму для добавления нового сна.
     *
     * @return View
     */
    public function create()
    {
        return view('dreams.create');
    }

    /**
     * Сохраняет новый сон.
     *
     * @param  StoreDreamRequest       $request
     * @param  UserRepositoryInterface $users
     * @return RedirectResponse
     */
    public function store(StoreDreamRequest $request, UserRepositoryInterface $users)
    {
        $user = $users->find($request->input('user_id'));

        $dream = $this->dreams->create([
            'title' => $request->input('title'),
            'body'  => $request->input('body'),
            'user'  => $user,
        ]);

        $this->dreams->save($dream);

        return redirect('dreams');
    }

    /**
     * Отдаёт сон.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $dream = $this->dreams->find($id);

        return view('dreams.show', [
            'dream' => $dream,
        ]);
    }

    /**
     * Отдаёт сон для редактирования.
     *
     * @param  int  $id
     * @return RedirectResponse|View
     */
    public function edit($id)
    {
        $dream = $this->dreams->find($id);

        if ($dream->getUser()->getId() !== Auth::user()->getId()) {
            return redirect('dreams');
        }

        return view('dreams.edit', [
            'dream' => $dream,
        ]);
    }

    /**
     * Редактирует сон.
     *
     * @param  StoreDreamRequest  $request
     * @param  int                $id
     * @return RedirectResponse
     */
    public function update(StoreDreamRequest $request, $id)
    {
        $dream = $this->dreams->find($id);

        if ($dream->getUser()->getId() !== Auth::user()->getId()) {
            return redirect('dreams');
        }

        $dream = $this->dreams->update([
            'title' => $request->input('title'),
            'body'  => $request->input('body'),
        ], $id);

        $this->dreams->save($dream);

        return redirect('dreams');
    }

    /**
     * Удаляет сон.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $dream = $this->dreams->find($id);

        if ($dream->getUser()->getId() === Auth::user()->getId()) {
            $this->dreams->delete($dream);
        }

        return redirect('dreams');
    }

    /**
     * Отдаёт все сны и чужие в том числе.
     *
     * @return View
     */
    public function all()
    {
        $dreams = $this->dreams->paginateAll(10);

        return view('dreams.all', [
            'dreams' => $dreams,
        ]);
    }
}

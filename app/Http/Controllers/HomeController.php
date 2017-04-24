<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DreamRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Конструктор.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Главная страница.
     *
     * @param  DreamRepository  $dreams
     * @return View
     */
    public function index(DreamRepository $dreams)
    {
        $dreams = $dreams->paginateAll(5);

        return view('home', [
            'dreams' => $dreams,
        ]);
    }
}

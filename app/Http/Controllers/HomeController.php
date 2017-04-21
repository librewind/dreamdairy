<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DreamRepository;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DreamRepository $dreams)
    {
        $dreams = $dreams->paginateAll(5);

        return view('home', [
            'dreams' => $dreams,
        ]);
    }
}

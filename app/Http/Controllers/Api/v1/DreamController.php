<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Repositories\DreamRepositoryInterface;

class DreamController
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

        //$this->middleware('auth');
    }

    public function index(Request $request)
    {
        $result = [];

        $result['current_page'] = $request->input('page') ?? 1;

        $result['per_page'] = 10;

        $allDreams = $this->dreams->findAll();

        $result['total'] = count($allDreams);

        $userId = 1;

        $dreams = $this->dreams->findAllByUserId($userId, 10);

        foreach ($dreams as $dream) {
            $item = [];

            $item['id'] = $dream->getId();

            $item['title'] = $dream->getTitle();

            $item['body'] = $dream->getBody();

            $result['data'][] = $item;
        }

        return [
            'dreams' => $result,
        ];
    }

    public function all(Request $request)
    {
        $result = [];

        $result['current_page'] = $request->input('page') ?? 1;

        $result['per_page'] = 10;

        $allDreams = $this->dreams->findAll();

        $result['total'] = count($allDreams);

        $dreams = $this->dreams->paginateAll(10);

        foreach ($dreams as $dream) {
            $item = [];

            $item['id'] = $dream->getId();

            $item['title'] = $dream->getTitle();

            $item['body'] = $dream->getBody();

            $result['data'][] = $item;
        }

        return [
            'dreams' => $result,
        ];
    }
}
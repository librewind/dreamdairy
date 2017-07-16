<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Repositories\DreamRepository;
use App\Entities\Dream;

class DreamController
{
    /**
     * @var DreamRepository
     */
    private $dreams;

    /**
     * Конструктор.
     *
     * @param  DreamRepository  $dreams
     */
    public function __construct(DreamRepository $dreams)
    {
        $this->dreams = $dreams;
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

        /** @var Dream $dream */
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
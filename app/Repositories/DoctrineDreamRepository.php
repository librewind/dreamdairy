<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;

class DoctrineDreamRepository extends EntityRepository implements DreamRepository
{
    use PaginatesFromRequest;

    public function findByTitle($title)
    {
        return $this->findBy(['title' => $title]);
    }
}
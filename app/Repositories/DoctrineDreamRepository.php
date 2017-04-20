<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class DoctrineDreamRepository extends EntityRepository implements DreamRepository
{
    public function findByTitle($title)
    {
        return $this->findBy(['title' => $title]);
    }
}
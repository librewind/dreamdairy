<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function findByName($name)
    {
        return $this->findBy(['name' => $name]);
    }
}
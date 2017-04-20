<?php

namespace App\Repositories;

interface UserRepository
{
    public function findAll();

    public function find($id);

    public function findByName($name);
}
<?php

namespace App\Repositories;

interface DreamRepository
{
    public function findAll();

    public function find($id);

    public function findByTitle($name);
}
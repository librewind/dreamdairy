<?php

namespace App\Repositories;

interface DreamRepositoryInterface
{
    public function create($data);

    public function update($data, $id);

    public function save($object);

    public function delete($object);

    public function find($id);

    public function findAll();

    public function findAllByUserId($userId, $perPage, $pageName);

    public function findByTitle($title);
}
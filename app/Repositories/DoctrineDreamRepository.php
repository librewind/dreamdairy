<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;
use Doctrine\Common\Inflector\Inflector;

class DoctrineDreamRepository extends EntityRepository implements DreamRepository
{
    use PaginatesFromRequest;

    public function create($data)
    {
        $entity = new $this->_entityName();

        return $this->prepare($entity, $data);
    }

    public function update($data, $id)
    {
        $entity = $this->find($id);

        return $this->prepare($entity, $data);
    }

    protected function prepare($entity, $data)
    {
        $set = 'set';

        $whitelist = $entity->whitelist();

        foreach ($whitelist as $field) {
            if (isset($data[$field])) {
                $setter = $set . Inflector::classify($field);

                $entity->$setter($data[$field]);
            }
        }

        return $entity;
    }

    public function save($object)
    {
        $this->_em->persist($object);

        $this->_em->flush($object);

        return $object;
    }

    public function delete($object)
    {
        $this->_em->remove($object);

        $this->_em->flush($object);

        return true;
    }

    public function findByTitle($title)
    {
        return $this->findBy(['title' => $title]);
    }
}
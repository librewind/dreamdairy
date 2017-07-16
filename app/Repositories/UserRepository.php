<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use App\Entities\User;
use Doctrine\Common\Inflector\Inflector;

class UserRepository extends EntityRepository
{
    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        $entity = new $this->_entityName();

        return $this->prepare($entity, $data);
    }

    /**
     * @param array $data
     * @param int $id
     *
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        /** @var User $entity */
        $entity = $this->find($id);

        return $this->prepare($entity, $data);
    }

    /**
     * @param User $entity
     * @param array $data
     *
     * @return User
     */
    protected function prepare(User $entity, array $data)
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

    /**
     * @param User $object
     *
     * @return User
     */
    public function save(User $object)
    {
        $this->_em->persist($object);

        $this->_em->flush($object);

        return $object;
    }

    /**
     * @param User $object
     *
     * @return bool
     */
    public function delete(User $object)
    {
        $this->_em->remove($object);

        $this->_em->flush($object);

        return true;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function findByName(string $name)
    {
        return $this->findBy(['name' => $name]);
    }
}

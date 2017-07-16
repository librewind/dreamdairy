<?php

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;
use Doctrine\Common\Inflector\Inflector;
use App\Entities\Dream;

class DreamRepository extends EntityRepository
{
    use PaginatesFromRequest;

    /**
     * @param array $data
     *
     * @return Dream
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
     * @return Dream
     */
    public function update(array $data, int $id)
    {
        /** @var Dream $entity */
        $entity = $this->find($id);

        return $this->prepare($entity, $data);
    }

    /**
     * @param Dream $entity
     * @param array $data
     *
     * @return mixed
     */
    protected function prepare(Dream $entity, array $data)
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
     * @param Dream $object
     *
     * @return Dream
     */
    public function save(Dream $object)
    {
        $this->_em->persist($object);
        $this->_em->flush($object);

        return $object;
    }

    /**
     * @param Dream $object
     *
     * @return bool
     */
    public function delete(Dream $object)
    {
        $this->_em->remove($object);
        $this->_em->flush($object);

        return true;
    }

    /**
     * @param string $title
     *
     * @return array
     */
    public function findByTitle(string $title)
    {
        return $this->findBy(['title' => $title]);
    }

    /**
     * @param $userId
     * @param int $perPage
     * @param string $pageName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findAllByUserId($userId, $perPage = 15, $pageName = 'page')
    {
        $query = $this->_em->createQuery('SELECT u FROM App\Entities\Dream u WHERE u.user = :userId');
        $query->setParameter('userId', $userId);

        return $this->paginate($query, $perPage, $pageName);
    }
}

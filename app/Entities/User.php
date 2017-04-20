<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements \Illuminate\Contracts\Auth\Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="Dream", mappedBy="user", cascade={"persist"})
     * @var ArrayCollection|Dream[]
     */
    protected $dreams;

    public function __construct($input)
    {
        $this->setName($input['name']);

        $this->setEmail($input['email']);

        $this->setPassword($input['password']);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function addDream(Dream $dream)
    {
        if (! $this->dreams->contains($dream)) {
            $dream->setScientist($this);

            $this->dreams->add($dream);
        }
    }

    public function getDreams()
    {
        return $this->dreams;
    }
}
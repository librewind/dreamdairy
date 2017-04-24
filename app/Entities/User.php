<?php

namespace App\Entities;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use App\Notifications\ResetPassword;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable;
    use CanResetPassword;
    use Notifiable;

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

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function __construct($input = null)
    {
        if (is_array($input)) {
            $this->setName($input['name']);

            $this->setEmail($input['email']);

            $this->setPassword($input['password']);
        }

        $this->dreams = new ArrayCollection();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function whitelist()
    {
        return [
            'name',
            'email',
            'password',
        ];
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
            $dream->setUser($this);

            $this->dreams->add($dream);
        }
    }

    public function getDreams()
    {
        return $this->dreams;
    }

    public function setDreams(ArrayCollection $dreams)
    {
        $this->dreams = $dreams;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }
}
<?php

namespace App\Support;

use App\Entities\User;
use App\Repositories\UserRepository;
use Tymon\JWTAuth\Providers\User\UserInterface;

class DoctrineUserAdapter implements UserInterface
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * Create a new User instance.
     *
     * @param  $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the user by the given key, value.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     *
     * @return User|bool
     */
    public function getBy($key, $value)
    {
        $users = $this->user->findBy([$key => $value]);

        if (count($users) > 0) {
            return $users[0];
        }

        return false;
    }
}

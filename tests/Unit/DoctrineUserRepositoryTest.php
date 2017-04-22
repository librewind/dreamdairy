<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App;
use App\Repositories\UserRepository;
use App\Entities\User;

class DoctrineUserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $repository;

    protected static $user;

    public function setUp()
    {
        parent::setUp();

        $this->repository = App::make(UserRepository::class);
    }

    public function testCreateAndSave()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'name'     => $faker->name,
            'email'    => $faker->unique()->safeEmail,
            'password' => bcrypt('123456'),
        ];

        $user = $this->repository->create($data);

        self::$user = $this->repository->save($user);

        $this->assertDatabaseHas('users', [
            'id' => self::$user->getId()
        ]);
    }

    public function testUpdateAndSave()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'name' => $faker->name,
        ];

        $user = $this->repository->update($data, self::$user->getId());

        self::$user = $this->repository->save($user);

        $this->assertEquals($data['name'], self::$user->getName());
    }

    public function testFindAll()
    {
        $users = $this->repository->findAll();

        $this->assertContainsOnlyInstancesOf(User::class, $users);
    }

    public function testDelete()
    {
        $user = $this->repository->find(self::$user->getId());

        $result = $this->repository->delete($user);

        $this->assertTrue($result);
    }
}

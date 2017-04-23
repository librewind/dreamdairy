<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App;
use App\Repositories\DreamRepository;
use App\Repositories\UserRepository;
use App\Entities\Dream;

class DoctrineDreamRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $repository;

    protected static $dream;

    protected static $user;

    public function setUp()
    {
        parent::setUp();

        $this->repository = App::make(DreamRepository::class);
    }

    public function testCreateAndSave()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'name'     => $faker->name,
            'email'    => $faker->unique()->safeEmail,
            'password' => bcrypt('123456'),
        ];

        $userRepository = App::make(UserRepository::class);

        $user = $userRepository->create($data);

        self::$user = $userRepository->save($user);

        $data = [
            'title' => $faker->sentence(),
            'body'  => $faker->text,
            'user'  => $user,
        ];

        $dream = $this->repository->create($data);

        self::$dream = $this->repository->save($dream);

        $this->assertDatabaseHas('dreams', [
            'id' => self::$dream->getId()
        ]);
    }

    public function testUpdateAndSave()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'title' => $faker->sentence(),
        ];

        $dream = $this->repository->update($data, self::$dream->getId());

        self::$dream = $this->repository->save($dream);

        $this->assertEquals($data['title'], self::$dream->getTitle());
    }

    public function testFindAll()
    {
        $dreams = $this->repository->findAll();

        $this->assertContainsOnlyInstancesOf(Dream::class, $dreams);
    }

    public function testFindAllByUserId()
    {
        $dreams = $this->repository->findAllByUserId(self::$user->getId());

        $this->assertContainsOnlyInstancesOf(Dream::class, $dreams);
    }

    public function testDelete()
    {
        $dream = $this->repository->find(self::$dream->getId());

        $result = $this->repository->delete($dream);

        $this->assertTrue($result);
    }
}

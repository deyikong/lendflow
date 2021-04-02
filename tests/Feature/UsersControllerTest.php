<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Faker\Factory;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    protected $indexStructure = [
        '*' => [
            'id',
            'email',
            'name',
        ]
    ];
    protected $showStructure = [
        'id',
        'email',
        'name',
    ];
    protected $updateStructure = [
        'id',
        'email',
        'name',
        'token',
    ];
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = \Faker\Factory::create();
    }

    public function testIndex()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
        $response->assertJsonStructure($this->indexStructure);
    }

    public function testStore(){
        $faker = Factory::create();
        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
        ];
        $response = $this->post('api/users', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure($this->showStructure);
        unset($data['password']);
        $this->assertDatabaseHas('users', $data);
    }

    public function testShow(){
        $user = User::factory()->create();
        $response = $this->get("/api/users/{$user->id}");
        $response->assertStatus(200);
        $response->assertJsonStructure($this->showStructure);
    }

    public function testUpdateValid()
    {
        $faker = Factory::create();
        $data = [
            'name' => $faker->name,
        ];
        $user = User::factory()->create();
        $response = $this->loggedIn()->put("/api/users", $data);
        $response->assertStatus(200);
        $response->assertJsonStructure($this->showStructure);

    }
}

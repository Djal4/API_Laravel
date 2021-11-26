<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function showUsers()
    {
        $this->get('/api/Users')
            ->assertStatus(200);
    }
    public function showUser()
    {
        $this->get('/api/Users/')//doraditi
            ->assertStatus(200);        
    }
    public function storeUser()
    {
        $this->post('/api/Users',[
            'name' => 'Alex',
            'lastname'=>'Woody',
            'skype' => 'woodie.alex',
            'mail' => 'alex@wood',
            'role_id'=>'1',
            'password'=>'12345678'
        ])
            ->assertStatus(201);
        $this->assertDatabaseHas('users', [
                'mail' => 'alex@wood',
            ]);
    }
    public function updateUser()
    {

    }
    public function deleteUser()
    {

    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends TestCase
{         

         public function test_example()
         {
            $data = [
                'name' => 'osama',
                'email' => 'osama3212@example.com',
                'password' => '123456'
            ];
    
            $response = $this->json('POST', '/api/auth/register', $data);
    
            $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Registered Successfully',
                ]);
        }

}

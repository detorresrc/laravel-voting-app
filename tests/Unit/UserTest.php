<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function can_check_if_user_is_admin()
    {
        $user1 = User::factory()->make([
            'name' => 'Rommel de Torres',
            'email' => 'detorresrc@gmail.com'
        ]);

        $user2 = User::factory()->make([
            'name' => 'Test',
            'email' => 'test@gmail.com'
        ]);

        $this->assertTrue($user1->isAdmin());
        $this->assertFalse($user2->isAdmin());
    }
}

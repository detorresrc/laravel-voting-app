<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GravatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_generate_gravatar_default_image_when_no_email_found_first_character_d()
    {
        $user = User::factory()->create([
            'name' => 'Mel',
            'email' => 'detorresrc@gmail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals("https://www.gravatar.com/avatar/".md5($user->email)."?s=200&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-4.png", $gravatarUrl);

        $response = Http::get($user->getAvatar());
        $this->assertTrue($response->successful());
    }

    /** @test */
    public function user_can_generate_gravatar_default_image_when_no_email_found_first_character_z()
    {
        $user = User::factory()->create([
            'name' => 'Mel',
            'email' => 'zdetorresrc@gmail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals("https://www.gravatar.com/avatar/".md5($user->email)."?s=200&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-26.png", $gravatarUrl);

        $response = Http::get($user->getAvatar());
        $this->assertTrue($response->successful());
    }
}

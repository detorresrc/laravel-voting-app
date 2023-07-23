<?php

namespace Tests\Feature;

use App\Http\Livewire\DeleteIdea;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shows_delete_idea_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
                ->get(route('idea.show', $idea))
                ->assertSeeLivewire('delete-idea');
    }

    /** @test */
    public function does_not_show_delete_idea_livewire_component_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($userB)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('delete-idea-idea');
    }

    /** @test */
    public function deleting_an_idea_works_when_user_has_authorization()
    {
        $user = User::factory()->create();;

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        $this->assertEquals(0, Idea::count());
    }

    /** @test */
    public function deleting_an_idea_will_throw_an_error_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();;
        $userB = User::factory()->create();;

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($userB)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call('deleteIdea')
            ->assertForbidden();
    }
}

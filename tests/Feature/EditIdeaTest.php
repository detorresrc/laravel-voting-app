<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Http\Livewire\EditIdea;
use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shows_edit_idea_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
                ->get(route('idea.show', $idea))
                ->assertSeeLivewire('edit-idea');
    }

    /** @test */
    public function does_not_show_edit_idea_livewire_component_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($userB)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('edit-idea');
    }

    /** @test */
    public function edit_idea_form_validation_works()
    {
        $user = User::factory()->create();;

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('category', '')
            ->set('title', '')
            ->set('description', '')
            ->call('updateIdea')
            ->assertHasErrors(['category', 'title', 'description'])
            ->assertSee('The title field is required');
    }

    /** @test */
    public function editing_an_idea_works_when_user_has_authorization()
    {
        $user = User::factory()->create();;

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $newCategory = Category::factory()->create();

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', 'Ako lang to!')
            ->set('description', 'Ako lang to! new Description')
            ->set('category', $newCategory->id)
            ->call('updateIdea')
            ->assertEmitted('ideaWasUpdated');

        $idea->refresh();
        $this->assertEquals('Ako lang to! new Description', $idea->description);
        $this->assertEquals('Ako lang to!', $idea->title);
        $this->assertEquals($newCategory->id, $idea->category_id);
    }
}

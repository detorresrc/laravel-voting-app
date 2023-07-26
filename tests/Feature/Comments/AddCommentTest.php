<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\AddComment;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function add_comment_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $response = $this->get(route('idea.show', $idea));
        $response->assertSuccessful()
            ->assertSeeLivewire('add-comment');
    }

    /** @test */
    public function forbidden_when_guest_will_try_to_add_comment()
    {
        $idea = Idea::factory()->create();

        Livewire::test(AddComment::class, [
                'idea' => $idea
            ])
            ->call('addComment')
            ->assertForbidden();
    }

    /** @test */
    public function add_comment_form_does_not_render_when_user_is_logged_out()
    {
        $idea = Idea::factory()->create();

        $this
            ->get(route('idea.show', $idea))
            ->assertSee('Please login or crete an account to post a comment.');
    }

    /** @test */
    public function add_comment_form_render_when_user_is_logged_in()
    {
        $idea = Idea::factory()->create();

        $this
            ->actingAs($idea->user)
            ->get(route('idea.show', $idea))
            ->assertSee('Go ahead');
    }

    /** @test */
    public function validation_works()
    {
        $idea = Idea::factory()->create();

        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', '')
            ->call('addComment')
            ->assertHasErrors(['comment'])
            ->assertSee('The comment field is required');
    }

    /** @test */
    public function adding_an_comment_works_perfectly()
    {
        $idea = Idea::factory()->create();

        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', 'This is my first comment!')
            ->call('addComment')
            ->assertHasNoErrors(['comment'])
            ->assertEmitted('ideaCommentWasAdded');

        $this->assertEquals(1, Comment::all()->count());
    }
}

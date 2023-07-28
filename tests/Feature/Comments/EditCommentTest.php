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

class EditCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function edit_comment_livewire_component_renders()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
            'body' => 'Lorem ipsum'
        ]);

        $response = $this->actingAs($user)->get(route('idea.show', $idea));
        $response->assertSuccessful()
            ->assertSeeLivewire('comment.edit-comment');
    }

    /** @test */
    public function edit_comment_livewire_component_will_not_renders_to_unauthorized_user()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
            'body' => 'Lorem ipsum'
        ]);

        $response = $this->get(route('idea.show', $idea));
        $response->assertSuccessful()
            ->assertDontSeeLivewire('comment.edit-comment');
    }

    /** @test */
    public function edit_comment_will_thrown_an_error_for_unauthorized_user()
    {
        $idea = Idea::factory()->create();
        $user = User::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $idea->user->id,
            'idea_id' => $idea->id,
            'body' => 'Lorem ipsum'
        ]);

        Livewire::test('comment.edit-comment')
            ->call('updateComment')
            ->assertForbidden()
            ;

        Livewire::actingAs($user)->test('comment.edit-comment')
            ->call('setEditComment', $comment->getRouteKey())
            ->call('updateComment')
            ->assertForbidden()
            ;
    }

    /** @test */
    public function edit_comment_validation_works()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user
        ]);


        $comment = Comment::factory()->create([
            'user_id' => $idea->user->id,
            'idea_id' => $idea->id,
            'body' => 'Lorem ipsum'
        ]);

        Livewire::actingAs($user)->test('comment.edit-comment')
            ->call('setEditComment', $comment->getRouteKey())
            ->set('body', '')
            ->call('updateComment')
            ->assertHasErrors(['body'])
            ->set('body', '123')
            ->call('updateComment')
            ->assertHasErrors(['body'])
            ->set('body', 'abcd')
            ->call('updateComment')
            ->assertHasNoErrors(['body'])
        ;
    }

    /** @test */
    public function edit_comment_works_perfectly()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
            'body' => 'Lorem ipsum'
        ]);

        Livewire::actingAs($user)->test('comment.edit-comment')
            ->call('setEditComment', $comment->getRouteKey())
            ->set('body', 'Lorem ipsum edited')
            ->call('updateComment')
            ->assertEmitted('ideaCommentWasUpdated')
            ;
    }
}

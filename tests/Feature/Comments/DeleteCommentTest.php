<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\Comment\DeleteComment;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function delete_comment_livewire_component_renders()
    {
        $idea = Idea::factory()->create();
        Comment::factory()->create([
            'body' => 'Lorem ipsum!'
        ]);

        $response = $this->actingAs($idea->user)->get(route('idea.show', $idea));
        $response->assertSuccessful()
            ->assertSeeLivewire('delete-idea');
    }

    /** @test */
    public function delete_comment_livewire_component_will_not_renders_for_guest_user()
    {
        $idea = Idea::factory()->create();
        Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $idea->user->id,
            'body' => 'Lorem ipsum!'
        ]);

        $response = $this->get(route('idea.show', $idea));
        $response->assertSuccessful()
            ->assertDontSeeLivewire('delete-idea');
    }

    /** @test */
    public function it_will_thrown_forbidden_if_user_has_no_authorization_to_delete_comment()
    {
        $userA = User::factory()->create([
            'email' => 'detorresrc-a@gmail.com'
        ]);
        $userB = User::factory()->create([
            'email' => 'detorresrc-b@gmail.com'
        ]);


        $idea = Idea::factory()->create([
            'user_id' => $userA->id
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $idea->user->id,
            'body' => 'Lorem ipsum!'
        ]);

        Livewire::test(DeleteComment::class )
            ->call('setDeleteComment', $comment->getRouteKey())
            ->assertEmitted('setEditCommentCompleted')
            ->assertViewHas('commendId', function($val) use ($comment){
               return $comment->getRouteKey()==$val;
            })
            ->call('deleteIdeaComment')
            ->assertForbidden();

        Livewire::actingAs($userB)->test(DeleteComment::class )
            ->call('setDeleteComment', $comment->getRouteKey())
            ->assertEmitted('setEditCommentCompleted')
            ->assertViewHas('commendId', function($val) use ($comment){
                return $comment->getRouteKey()==$val;
            })
            ->call('deleteIdeaComment')
            ->assertForbidden();
    }

    /** @test */
    public function delete_an_comment_works_perfectly()
    {
        $userA = User::factory()->create([
            'email' => 'detorresrc-a@gmail.com'
        ]);
        $idea = Idea::factory()->create([
            'user_id' => $userA->id
        ]);
        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $idea->user->id,
            'body' => 'Lorem ipsum!'
        ]);

        Livewire::actingAs($userA)->test(DeleteComment::class )
            ->call('setDeleteComment', $comment->getRouteKey())
            ->assertEmitted('setEditCommentCompleted')
            ->assertViewHas('commendId', function($val) use ($comment){
                return $comment->getRouteKey()==$val;
            })
            ->call('deleteIdeaComment')
            ->assertEmitted('ideaCommentWasDeleted');

        $this->assertEquals(0, Comment::count());
    }
}

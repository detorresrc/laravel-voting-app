<?php

namespace Tests\Feature\Comments;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowCommentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function idea_comments_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $comment1 = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'Ako lang to!'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSuccessful()
            ->assertSeeLivewire('idea-comments')
            ->assertSeeLivewire('idea-comment');
    }

    /** @test */
    public function no_comments_shows_appropriate_message()
    {
        $idea = Idea::factory()->create();

        $this->get(route('idea.show', $idea))
            ->assertSuccessful()
            ->assertSee('No comments yet');
    }

    /** @test */
    public function list_of_comments_shows_on_idea_page()
    {
        $idea = Idea::factory()->create();

        $comment1 = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'Ako lang to! #1'
        ]);

        $comment2 = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'Ako lang to! #2'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSuccessful()
            ->assertSeeInOrder([$comment1->body, $comment2->body])
            ->assertSee('2 Comments');
    }

    /** @test */
    public function comments_counts_shows_correctly_on_index_page()
    {
        $idea = Idea::factory()->create();

        $comment1 = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'Ako lang to! #1'
        ]);

        $comment2 = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'Ako lang to! #2'
        ]);

        $this->get(route('idea.index'))
            ->assertSuccessful()
            ->assertSee('2 Comments');
    }

    /** @test */
    public function op_badge_shows_if_author_of_idea_comments_on_idea()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $commentOne = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
            'body' => 'This is my first comment'
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSuccessful()
            ->assertSee('OP');
    }

    /** @test */
    public function op_badge_does_not_shows_if_other_user_comments_on_idea()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $commentOne = Comment::factory()->create([
            'user_id' => $user2->id,
            'idea_id' => $idea->id,
            'body' => 'This is my first comment'
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSuccessful()
            ->assertDontSee('OP');
    }
}

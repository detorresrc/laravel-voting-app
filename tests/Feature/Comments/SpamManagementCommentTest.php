<?php

namespace Tests\Feature\Comments;

use App\Http\Livewire\Comment\MarkCommentAsNotSpam;
use App\Http\Livewire\Comment\MarkCommentAsSpam;
use App\Http\Livewire\MarkIdeaAsSpam;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SpamManagementCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function spam_livewire_renders_correctly()
    {
        $user = User::factory()->create([
            'email' => 'detorresrc@gmail.com'
        ]);

        $idea = Idea::factory()->create([
                'user_id' => $user->id
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body' => 'Ako lang to!'
        ]);

        $this->actingAs($user)->get(route('idea.show', $idea))
            ->assertSeeLivewire('mark-idea-as-spam')
            ->assertSeeLivewire('mark-idea-as-not-spam')
            ->assertSee($comment->body)
            ;
    }

    /** @test */
    public function it_will_thrown_a_forbidden_error_for_unauthorized_user()
    {
        Idea::factory()->create();

        $comment = Comment::factory()->create();

        Livewire::test(MarkCommentAsSpam::class)
            ->call('setMarkAsSpamComment', $comment->getRouteKey())
            ->assertEmitted('setMarkAsSpamCommentCompleted')
            ->call('markAsSpam')
            ->assertForbidden()
            ;
    }

    /** @test */
    public function mark_as_spam_comment_works_perfectly()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)->test(MarkCommentAsSpam::class)
            ->call('setMarkAsSpamComment', $comment->getRouteKey())
            ->assertEmitted('setMarkAsSpamCommentCompleted')
            ->call('markAsSpam')
            ->assertEmitted('ideaCommentWasMarkAsSpam')
        ;

        Livewire::actingAs($userB)->test(MarkCommentAsSpam::class)
            ->call('setMarkAsSpamComment', $comment->getRouteKey())
            ->assertEmitted('setMarkAsSpamCommentCompleted')
            ->call('markAsSpam')
            ->assertEmitted('ideaCommentWasMarkAsSpam')
        ;

        $comment->refresh();

        $this->assertEquals(2, $comment->spam_reports);
    }

    /** @test */
    public function mark_as_not_spam_comment_works_perfectly()
    {
        $user = User::factory()->create([
            'email' => 'detorresrc@gmail.com'
        ]);
        $userB = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        Livewire::actingAs($userB)->test(MarkCommentAsNotSpam::class)
            ->call('setMarkAsNotSpamComment', $comment->getRouteKey())
            ->assertEmitted('setMarkAsNotSpamCommentCompleted')
            ->call('markAsNotSpam')
            ->assertForbidden()
        ;

        Livewire::actingAs($user)->test(MarkCommentAsNotSpam::class)
            ->call('setMarkAsNotSpamComment', $comment->getRouteKey())
            ->assertEmitted('setMarkAsNotSpamCommentCompleted')
            ->call('markAsNotSpam')
            ->assertEmitted('ideaCommentWasMarkAsNotSpam')
        ;

        $comment->refresh();

        $this->assertEquals(0, $comment->spam_reports);
    }
}

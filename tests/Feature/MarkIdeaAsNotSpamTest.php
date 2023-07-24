<?php


use App\Http\Livewire\MarkIdeaAsNotSpam;
use App\Http\Livewire\MarkIdeaAsSpam;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MarkIdeaAsNotSpamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shows_mark_idea_as_not_spam_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create([
            'email' => 'detorresrc@gmail.com'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('mark-idea-as-not-spam');
    }

    /** @test */
    public function does_not_show_mark_idea_as_not_spam_livewire_component_when_user_does_not_have_authorization()
    {
        $this->get(route('idea.show', Idea::factory()->create()))
            ->assertDontSeeLivewire('mark-idea-as-not-spam');
    }

    /** @test */
    public function mark_idea_as_not_spam_works_if_user_has_authorization()
    {
        $user = User::factory()->create([
            'email' => 'detorresrc@gmail.com'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'spam_reports' => 100
        ]);

        $this->assertEquals(100, $idea->spam_reports);

        Livewire::actingAs($user)
            ->test(MarkIdeaAsNotSpam::class, [
                'idea' => $idea
            ])
            ->call('markAsNotSpam')
            ->assertEmitted('ideaWasMarkedAsNotSpam');

        $idea->refresh();

        $this->assertEquals(0, $idea->spam_reports);
    }

    /** @test */
    public function mark_idea_as_not_spam_doest_not_works_if_user_has_no_authorization()
    {
        Livewire::test(MarkIdeaAsNotSpam::class, [
                'idea' => Idea::factory()->create()
            ])
            ->call('markAsNotSpam')
            ->assertForbidden();;
    }
}

<?php

namespace Tests\Feature;

use App\Http\Livewire\MarkIdeaAsSpam;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MarkIdeaAsSpamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shows_mark_idea_as_spam_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create([
            'email' => 'detorresrc@gmail.com'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('mark-idea-as-spam');
    }

    /** @test */
    public function does_not_show_mark_idea_as_spam_livewire_component_when_user_does_not_have_authorization()
    {
        $this->get(route('idea.show', Idea::factory()->create()))
            ->assertDontSeeLivewire('mark-idea-as-spam');
    }

    /** @test */
    public function mark_idea_as_spam_works_if_user_has_authorization()
    {
        $user = User::factory()->create([
            'email' => 'detorresrc@gmail.com'
        ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(MarkIdeaAsSpam::class, [
                'idea' => $idea
            ])
            ->call('markAsSpam')
            ->assertEmitted('ideaWasMarkedAsSpam')
            ->call('markAsSpam')
            ->assertEmitted('ideaWasMarkedAsSpam');

        $idea->refresh();

        $this->assertEquals(2, $idea->spam_reports);
    }

    /** @test */
    public function mark_idea_as_spam_doest_not_works_if_user_has_no_authorization()
    {
        Livewire::test(MarkIdeaAsSpam::class, [
                'idea' => Idea::factory()->create()
            ])
            ->call('markAsSpam')
            ->assertForbidden();;
    }
}

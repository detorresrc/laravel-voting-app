<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteShowPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_contains_idea_livewire_components()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-show');
    }

    /** @test */
    public function show_page_correctly_receives_votes_count()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $userB->id
        ]);

        $this->get(route('idea.show', $idea))
            ->assertViewHas('votesCount', 2);
    }

    /** @test */
    public function votes_count_shows_correctly_on_show_page_livewire_component()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $votesCount = 5;

        Livewire::test(IdeaShow::class, [
            'idea' => $idea,
            'votesCount' => $votesCount
        ])
        ->assertSet('votesCount', $votesCount);
    }

    /** @test */
    public function user_who_is_logged_in_shows_voted_if_idea_already_voted_for()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        $votesCount = 5;

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => $votesCount
            ])
            ->assertSet('hasVoted', true)
            ->assertSet('votesCount', $votesCount);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => $votesCount
            ])
            ->assertSet('hasVoted', false)
            ->assertSet('votesCount', $votesCount);
    }
}

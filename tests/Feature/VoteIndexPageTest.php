<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_contains_idea_livewire_components()
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

        $this->get(route('idea.index'))
            ->assertSeeLivewire('idea-index');
    }

    /** @test */
    public function livewire_index_correctly_receives_votes_count()
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

        Livewire::test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas){
                return (int)$ideas->first()->votes_count === 2;
            });
    }

    /** @test */
    public function votes_count_shows_correctly_on_index_page_livewire_component()
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

        for($i=1;$i<=9;$i++){
            Vote::factory()->create([
                'idea_id' => $idea->id,
                'user_id' => User::factory()->create()->id
            ]);
        }

        $idea = Idea::addSelect(['voted_by_user' =>
                Vote::select('id')
                    ->where('user_id', $user->id)
                    ->whereColumn('idea_id', 'ideas.id')
            ])
            ->withCount('votes')
            ->first();

        Livewire::actingAs($user)->test(IdeaIndex::class, [
            'idea' => $idea
        ])
        ->assertViewHas('idea', function(Idea $idea){
            return $idea->voted_by_user && $idea->votes_count === 10;
        });

        $idea = Idea::addSelect(['voted_by_user' =>
            Vote::select('id')
                ->where('user_id', $userB->id)
                ->whereColumn('idea_id', 'ideas.id')
        ])
            ->withCount('votes')
            ->first();

        Livewire::actingAs($userB)->test(IdeaIndex::class, [
            'idea' => $idea
        ])
        ->assertViewHas('idea', function(Idea $idea){
            return !$idea->voted_by_user && $idea->votes_count === 10;
        });
    }

    /** @test */
    public function user_who_is_not_logged_in_is_redirected_to_login_page_when_trying_to_vote()
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

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea
        ])
        ->call('vote')
        ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_who_is_logged_in_can_vote_for_idea()
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

        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $idea
            ])
            ->call('vote')
            ->assertSet('hasVoted', true);

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);
    }

    /** @test */
    public function user_who_is_logged_in_can_unvote_for_idea()
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

        $idea = Idea::addSelect(['voted_by_user' =>
            Vote::select('id')
                ->where('user_id', $user->id)
                ->whereColumn('idea_id', 'ideas.id')
        ])
            ->withCount('votes')
            ->first();


        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $idea
            ])
            ->call('vote')
            ->assertSet('hasVoted', false);

        $this->assertDatabaseMissing('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);
    }
}

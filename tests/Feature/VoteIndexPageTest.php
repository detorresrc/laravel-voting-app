<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
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
    public function index_page_correctly_receives_votes_count()
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

        $this->get(route('idea.index'))
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

        $response = $this->actingAs($user)->get(route('idea.index'));
        $insertedIdea = ($response['ideas']->items()[0]);

        Livewire::actingAs($user)->test(IdeaIndex::class, [
            'idea' => $insertedIdea
        ])
        ->assertViewHas('idea', function(Idea $idea){
            return $idea->voted_by_user && $idea->votes_count === 10;
        });

        $response = $this->actingAs($userB)->get(route('idea.index'));
        $insertedIdea = ($response['ideas']->items()[0]);

        Livewire::actingAs($userB)->test(IdeaIndex::class, [
            'idea' => $insertedIdea
        ])
        ->assertViewHas('idea', function(Idea $idea){
            return !$idea->voted_by_user && $idea->votes_count === 10;
        });
    }
}

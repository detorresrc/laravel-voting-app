<?php

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function searching_works_when_more_than_3_characters()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);
        $status4 = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-green text-white']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        $idea3 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status4->id,
            'title' => 'My Third Idea Title',
            'description' => 'My Third Idea Description'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user->id
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'Second')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 1 && $ideas->first()->votes()->count() == 0 && $ideas->first()->title=='My Second Idea Title';
            })
            ->set('search', 'First')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 1 && $ideas->first()->votes()->count() == 1 && $ideas->first()->title=='My First Idea Title';
            });
    }

    /** @test */
    public function does_not_perform_search_if_less_than_3_characters()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);
        $status4 = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-green text-white']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        $idea3 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status4->id,
            'title' => 'My Third Idea Title',
            'description' => 'My Third Idea Description'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user->id
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'ab')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 3;
            });
    }

    /** @test */
    public function search_works_correctly_with_category_filters()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);
        $status4 = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-green text-white']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        $idea3 = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'status_id' => $status4->id,
            'title' => 'My Third Idea Title',
            'description' => 'My Third Idea Description'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea2->id,
            'user_id' => $user->id
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', $category1->name)
            ->set('search', 'Idea')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 2 && $ideas->first()->votes_count == 1;
            });
    }
}

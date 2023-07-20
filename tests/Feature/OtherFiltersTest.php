<?php
namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OtherFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function top_voted_filter_works()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

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
            'user_id' => $userB->id,
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

        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $userB->id
        ]);

        Vote::factory()->create([
            'idea_id' => $idea2->id,
            'user_id' => $userC->id
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('filter', 'Top Voted')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 3 && $ideas->first()->votes()->count() == 2;
            });
    }

    /** @test */
    public function my_ideas_filter_works()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

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
            'user_id' => $userB->id,
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

        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $userB->id
        ]);

        Vote::factory()->create([
            'idea_id' => $idea2->id,
            'user_id' => $userC->id
        ]);

        Vote::factory()->create([
            'idea_id' => $idea3->id,
            'user_id' => $user->id
        ]);
        Vote::factory()->create([
            'idea_id' => $idea3->id,
            'user_id' => $userB->id
        ]);
        Vote::factory()->create([
            'idea_id' => $idea3->id,
            'user_id' => $userC->id
        ]);

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 2 && $ideas->first()->votes()->count() == 3;
            });
    }

    /** @test */
    public function my_ideas_filter_redirect_to_login_if_not_logged_in()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function my_ideas_filter_works_correctly_with_categories_filter()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

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
            'user_id' => $userB->id,
            'category_id' => $category2->id,
            'status_id' => $status4->id,
            'title' => 'My Third Idea Title',
            'description' => 'My Third Idea Description'
        ]);

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->set('category', $category1->name)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 2;
            })
            ->set('filter', 'My Ideas')
            ->set('category', $category2->name)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 0;
            })
            ->set('filter', '')
            ->set('category', 'All Categories')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 3;
            });
    }
}

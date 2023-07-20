<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function select_a_category_filters_category()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);
        $status4 = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-green text-white']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', 'Category 1')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 2;
            })
            ->set('category', 'Category 2')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 1;
            })
            ->set('category', 'All')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 3;
            });
    }

    /** @test */
    public function the_category_query_string_filters_correctly()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);
        $status4 = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-green text-white']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Livewire::withQueryParams(['category' => 'Category 1'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 2;
            });

        Livewire::withQueryParams(['category' => 'Category 2'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 1;
            });

        Livewire::withQueryParams(['category' => 'All'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 3;
            });
    }

    /** @test */
    public function select_a_status_and_a_category_filters_category()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);
        $status4 = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-green text-white']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', $category1->name)
            ->set('status', $status1->name)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 2;
            })
            ->set('category', $category2->name)
            ->set('status', $status4->name)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 1;
            })
            ->set('category', 'All Categories')
            ->set('status', 'All')
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 3;
            });
    }

    /** @test */
    public function the_status_and_category_query_string_filters_correctly()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);
        $status1 = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);
        $status4 = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-green text-white']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'status_id' => $status4->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Livewire::withQueryParams(['category' => $category1->name, 'status' => $status1->name])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 2;
            });

        Livewire::withQueryParams(['category' => $category2->name, 'status' => $status4->name])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 1;
            });

        Livewire::withQueryParams(['category' => 'All Categories', 'status' => 'All'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function($ideas){
                return $ideas->count() == 3;
            });
    }
}

<?php

namespace Tests\Feature;

use App\Http\Livewire\StatusFilters;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StatusFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_contains_status_filters_livewire_component()
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
            ->assertSeeLivewire('status-filters');
    }

    /** @test */
    public function show_page_contains_status_filters_livewire_component()
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
            ->assertSeeLivewire('status-filters');
    }

    /** @test */
    public function shows_correct_status_count()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['id' => 4, 'name'=>'Implemented', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My Second Idea Title',
            'description' => 'My Second Idea Description'
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('All Ideas (2)')
            ->assertSee('Implemented (2)');
    }

    /** @test */
    public function filtering_works_when_query_string_in_place()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
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

        $response = $this->get(route('idea.index'));
        $response->assertSuccessful();
        $response->assertSee('<div class="'.$status1->classes.' text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">'.$status1->name.'</div>', false);
        $response->assertSee('<div class="'.$status4->classes.' text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">'.$status4->name.'</div>', false);

        $response = $this->get(route('idea.index', [
            'status' => $status1->name
        ]));
        $response->assertSuccessful();
        $response->assertSee('<div class="'.$status1->classes.' text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">'.$status1->name.'</div>', false);
        $response->assertDontSee('<div class="'.$status4->classes.' text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">'.$status4->name.'</div>', false);
    }

    /** @test */
    public function show_page_does_not_show_selected_status()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $response = $this->get(route('idea.show', $idea));
        $response->assertDontSee('border-blue text-gray-900');
    }

    /** @test */
    public function index_page_show_selected_status()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['id' => 2, 'name'=>'Considering', 'classes'=>'bg-purple text-white']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $response = $this->get(route('idea.index'));
        $response->assertSee('border-blue text-gray-900');
    }
}

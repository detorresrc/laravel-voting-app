<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_ideas_shows_on_main_page()
    {
        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);

        $statusOpen = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name'=>'Considering', 'classes'=>'bg-purple text-white']);

        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Description of my first Idea',
            'status_id' => $statusOpen->id,
            'category_id' => $category1->id
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My Second Idea',
            'description' => 'Description of my second Idea',
            'status_id' => $statusConsidering->id,
            'category_id' => $category2->id
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();

        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaOne->description);
        $response->assertSee($ideaOne->category->name);
        $response->assertSee('<div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">'.$ideaOne->status->name.'</div>', false);

        $response->assertSee($ideaTwo->title);
        $response->assertSee($ideaTwo->description);
        $response->assertSee($ideaTwo->category->name);
        $response->assertSee('<div class="bg-purple text-white text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">'.$ideaTwo->status->name.'</div>', false);
    }

    /** @test */
    public function single_idea_shows_on_show_page()
    {
        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $statusOpen = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Description of my first Idea',
            'category_id' => $category1->id,
            'status_id' => $statusOpen->id,
        ]);

        $response = $this->get(route('idea.show', $ideaOne));

        $response->assertSuccessful();

        $response->assertSee($ideaOne->title);
        $response->assertSee($ideaOne->description);
        $response->assertSee($ideaOne->category->name);
        $response->assertSee('<div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">'.$ideaOne->status->name.'</div>', false);
    }

    /** @test */
    public function in_app_back_button_works_when_index_page_visited_first()
    {
        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $category2 = Category::factory()->create(['name'=>'Category 2']);

        $statusOpen = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name'=>'Considering', 'classes'=>'bg-purple text-white']);

        $ideaOne = Idea::factory()->create([
            'title' => 'My First Idea',
            'description' => 'Description of my first Idea',
            'status_id' => $statusOpen->id,
            'category_id' => $category1->id
        ]);

        $responseA = $this->get(route('idea.index', [
                        'category' => $category1->name,
                        'status' => $statusOpen->name
                    ]));

        $responseB = $this->get(route('idea.show', $ideaOne) );

        $this->assertStringContainsString(
            explode("?", route('idea.index', [
                'category' => $category1->name,
                'status' => $statusOpen->name
            ]))[1] ?? null,
            $responseB['backurl']
        );
    }
}

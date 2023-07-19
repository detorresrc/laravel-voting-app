<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_idea_form_does_not_show_when_logout()
    {
        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee('Please login to create an idea.');
        $response->assertDontSee("Let us know what you would like and we'll take a look over!", false);
    }

    /** @test */
    public function create_idea_form_does_show_when_login()
    {
        $response = $this->actingAs(User::factory()->create())->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertDontSee('Please login to create an idea.');
        $response->assertSee("Let us know what you would like and we'll take a look over!", false);
    }

    /** @test */
    public function main_page_contains_create_idea_livewire_component()
    {
        $this->actingAs(User::factory()->create())
            ->get(route('idea.index'))
            ->assertSeeLivewire('create-idea');
    }

    /** @test */
    public function create_idea_form_validation_works()
    {
        Livewire::actingAs(User::factory()->create())
                ->test(CreateIdea::class)
                ->set('title', '')
                ->set('category', '')
                ->set('description', '')
                ->call('createIdea')
                ->assertHasErrors(['title', 'category', 'description'])
                ->assertSee('The title field is required');
    }

    /** @test */
    public function creating_an_idea_works_correctly()
    {
        $text = "-".time();

        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1'.$text]);
        Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'My First Idea Title'.$text)
            ->set('category', $category1->id)
            ->set('description', 'My First Idea Description'.$text)
            ->call('createIdea')
            ->assertRedirect(route('idea.index'));

        $idea = Idea::latest()->first();

        $response = $this->actingAs($user)->get(route('idea.show', $idea));
        $response
            ->assertSuccessful()
            ->assertSee('My First Idea Title'.$text)
            ->assertSee('My First Idea Description'.$text)
            ->assertSee($category1->name);

        $this->assertDatabaseHas('ideas', [
            'title' => 'My First Idea Title'.$text
        ]);
    }
}

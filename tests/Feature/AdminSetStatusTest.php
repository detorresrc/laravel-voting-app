<?php

namespace Tests\Feature;

use App\Http\Livewire\SetStatus;
use App\Jobs\NotifyAllVoters;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class AdminSetStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function show_page_contains_set_status_livewire_component_when_user_is_admin()
    {
        $user = User::factory()->create([
            'name' => 'Rommel',
            'email' => 'detorresrc@gmail.com'
        ]);

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $response = $this
                        ->actingAs($user)
                        ->get(route('idea.show', $idea));
        $response->assertSeeLivewire('set-status');
    }

    /** @test  */
    public function show_page_does_not_contains_set_status_livewire_component_when_user_is_admin()
    {
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@gmail.com'
        ]);

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('idea.show', $idea));
        $response->assertDontSeeLivewire('set-status');
    }

    /** @test */
    public function initial_status_is_set_correctly()
    {
        $user = User::factory()->create([
            'name' => 'Rommel',
            'email' => 'detorresrc@gmail.com'
        ]);

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
                ->test(SetStatus::class, [
                    'idea' => $idea
                ])
                ->assertSet('status', $status->id)
                ->assertSet('idea', $idea)
                ;
    }

    /** @test */
    public function can_set_status_correctly()
    {
        $user = User::factory()->create([
            'name' => 'Rommel',
            'email' => 'detorresrc@gmail.com'
        ]);

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status1 = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);
        $status2 = Status::factory()->create(['name'=>'Considering', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea
            ])
            ->set('status', $status2->id)
            ->assertSet('status', $status2->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated')
            ;

        $idea->refresh();

        $this->assertEquals($idea->status_id, $status2->id);
    }

    /** @test */
    public function can_set_status_correctly_while_notifying_all_voters()
    {
        $user = User::factory()->create([
            'name' => 'Rommel',
            'email' => 'detorresrc@gmail.com'
        ]);

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status1 = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);
        $status2 = Status::factory()->create(['name'=>'Considering', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Queue::fake();

        Queue::assertNothingPushed();

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea
            ])
            ->set('status', $status2->id)
            ->set('notifyAllVoters', true)
            ->assertSet('status', $status2->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated')
            ;

        Queue::assertPushed(NotifyAllVoters::class);
    }

    /** @test */
    public function can_set_status_with_comment_correctly()
    {
        $user = User::factory()->create([
            'name' => 'Rommel',
            'email' => 'detorresrc@gmail.com'
        ]);

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status1 = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);
        $status2 = Status::factory()->create(['name'=>'Considering', 'classes'=>'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea
            ])
            ->set('status', $status2->id)
            ->set('comment', '')
            ->assertSet('status', $status2->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated')
        ;

        $idea->refresh();

        $this->assertEquals($idea->status_id, $status2->id);
        $this->assertEquals('No comment was added', $idea->comments[0]['body']);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea
            ])
            ->set('status', $status2->id)
            ->set('comment', 'ako lang to!')
            ->assertSet('status', $status2->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated')
        ;

        $idea->refresh();
        $this->assertEquals('ako lang to!', $idea->comments[1]['body']);
    }
}

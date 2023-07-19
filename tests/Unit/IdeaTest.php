<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function can_check_if_idea_is_voted_for_by_user()
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

        $this->assertTrue($idea->isVotedByUser($user));
        $this->assertFalse($idea->isVotedByUser($userB));
        $this->assertFalse($idea->isVotedByUser(null));
    }
}

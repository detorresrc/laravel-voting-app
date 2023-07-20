<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

   /** @test */
    public function can_get_count_of_each_status()
    {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['name'=>'Category 1']);

        $statusOpen = Status::factory()->create(['name'=>'Open', 'classes'=>'']);
        $statusConsidering = Status::factory()->create(['name'=>'Considering', 'classes'=>'']);
        $statusInProgress = Status::factory()->create(['name'=>'In Progress', 'classes'=>'']);
        $statusImplemented = Status::factory()->create(['name'=>'Implemented', 'classes'=>'']);
        $statusClosed = Status::factory()->create(['name'=>'Closed', 'classes'=>'']);

        for($i=1; $i<=$statusOpen->id; $i++){
            Idea::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category1,
                'status_id' => $statusOpen->id
            ]);
        }
        for($i=1; $i<=$statusConsidering->id; $i++){
            Idea::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category1,
                'status_id' => $statusConsidering->id
            ]);
        }
        for($i=1; $i<=$statusInProgress->id; $i++){
            Idea::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category1,
                'status_id' => $statusInProgress->id
            ]);
        }
        for($i=1; $i<=$statusImplemented->id; $i++){
            Idea::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category1,
                'status_id' => $statusImplemented->id
            ]);
        }
        for($i=1; $i<=$statusClosed->id; $i++){
            Idea::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category1,
                'status_id' => $statusClosed->id
            ]);
        }

        $statuses = Status::getStatusCount();

        $this->assertEquals(15, array_sum($statuses));

        $this->assertEquals(1, $statuses[1]);
        $this->assertEquals(2, $statuses[2]);
        $this->assertEquals(3, $statuses[3]);
        $this->assertEquals(4, $statuses[4]);
        $this->assertEquals(5, $statuses[5]);
    }
}

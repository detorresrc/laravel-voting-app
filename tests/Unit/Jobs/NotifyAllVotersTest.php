<?php

namespace Tests\Unit\Jobs;

use App\Jobs\NotifyAllVoters;
use App\Mail\IdeaStatusUpdatedMailable;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NotifyAllVotersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_an_email_to_voters()
    {
        $user1 = User::factory()->create([
            'name' => 'Rommel 1',
            'email' => 'detorresrc1@gmail.com'
        ]);
        $user2 = User::factory()->create([
            'name' => 'Rommel 2',
            'email' => 'detorresrc2@gmail.com'
        ]);

        $category1 = Category::factory()->create(['name'=>'Category 1']);
        $status1 = Status::factory()->create(['name'=>'Open', 'classes'=>'bg-gray-200']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
            'status_id' => $status1->id,
            'title' => 'My First Idea Title',
            'description' => 'My First Idea Description'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user1->id
        ]);
        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user2->id
        ]);

        Mail::fake();

        NotifyAllVoters::dispatch($idea1);

        Mail::assertQueued(IdeaStatusUpdatedMailable::class, function($mail) use ($user1){
            return $mail->hasTo($user1->email);
        });

        Mail::assertQueued(IdeaStatusUpdatedMailable::class, function($mail) use ($user2){
            return $mail->hasTo($user2->email);
        });
    }
}

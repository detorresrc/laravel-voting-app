<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Rommel de Torres',
            'email' => 'detorresrc@gmail.com'
        ]);

        User::factory(19)->create();

        for($c=1;$c<=4;$c++):
        Category::factory()->create([
            'id' => $c,
            'name' => 'Category '. $c
        ]);
        endfor;

        Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);
        Status::factory()->create(['name' => 'In Progress', 'classes' => 'bg-yellow text-white']);
        Status::factory()->create(['name' => 'Implemented', 'classes' => 'bg-green text-white']);
        Status::factory()->create(['name' => 'Closed', 'classes' => 'bg-red text-white']);

        Idea::factory(100)->existing()->create();

        foreach(range(1,20) as $userId){
            foreach(range(1, 100) as $ideaId){
                if($ideaId % 2 !== 0) continue;

                Vote::factory()->create([
                    'user_id' => $userId,
                    'idea_id' => $ideaId
                ]);
            }
        }
    }
}

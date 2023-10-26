<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Plant;
use App\Models\Garden;
use App\Models\Location;
use App\Models\Sublocation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::factory()->create([
            'name' => 'Masa',
            'email' => 'naoh421@gmail.com'
        ]);

        Location::factory()->create([
            'user_id' => $user->id,
            'name' => 'Frontyard',
            'description' => 'Frontyard garden'
        ]);    
        Location::factory()->create([
            'user_id' => $user->id,
            'name' => 'Backyard',
            'description' => 'Backyard garden'
        ]);    
        Garden::factory()->create([
            'user_id' => $user->id,
            'name' => 'Rose Garden',
            'location' => 1,
            'width' => 300,
            'length' => 200,
            'description' => 'Front of the entrance'
        ]);    
        Garden::factory()->create([
            'user_id' => $user->id,
            'name' => "Masa's Garden",
            'location' => 1,
            'width' => 100,
            'length' => 500,
            'image' => 'gardens/xOvDoBvtWqtS2fbtbNTwauzrFLsRk6pzzPTIkPQs.jpg',
            'description' => "Front of Masa's bedroom"
        ]);   
        Plant::factory()->create([
            'user_id' => $user->id,
            'name' => "Olive",
            'planted' => '2023/03/20',
            'garden' => 2,
            'positionx' => 30,
            'positiony' => 60,
            'description' => "My Olive for 10 years",
            'size' => 60,
            'color' => 'olive'
        ]);
        Plant::factory()->create([
            'user_id' => $user->id,
            'name' => "Geranium",
            'planted' => '2023/08/10',
            'garden' => 2,
            'positionx' => 120,
            'positiony' => 40,
            'description' => "We bought this plant fromo Bunnings",
            'size' => 40,
            'color' => 'green'
        ]);
        Plant::factory()->create([
            'user_id' => $user->id,
            'name' => "Cypress",
            'planted' => '2023/05/15',
            'garden' => 2,
            'positionx' => 180,
            'positiony' => 80,
            'description' => "My favorite",
            'size' => 30,
            'color' => 'lightgreen'
        ]);
           
    }
}

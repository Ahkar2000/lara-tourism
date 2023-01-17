<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         \App\Models\Inquiry::factory(30)->create();
        //  \App\Models\Package::factory(10)->create();
        //  \App\Models\Comment::factory(200)->create();
        //  \App\Models\Booking::factory(30)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
        ]);

        $photos = Storage::allFiles("public");
        array_shift($photos);
        Storage::delete($photos);
        echo "\e[93mStorage cleared!\n";
    }
}

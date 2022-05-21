<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Website::factory(5)->create();

        $websites = Website::all();
        $websitesCount = $websites->count();

        //Get all users
        //Loop to each user
        //Get random websites between id 1-5
        //Make relation between user and website
        User::all()->each( function ($user) use ($websites, $websitesCount) {
           $user->websites()->sync(
             $websites->random(rand(1, $websitesCount))->pluck('id')->toArray()
           );
        });
    }
}

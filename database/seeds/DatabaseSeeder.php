<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ChannelsTableSeeder::class);
        $this->call(CommunityLinksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
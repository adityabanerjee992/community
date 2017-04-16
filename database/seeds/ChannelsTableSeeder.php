<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{	

	protected $channels = 
							[
								'1' =>  [	
											'title' => 'PHP', 
											'slug' => 'php', 
											'color' => 'red'
										], 
								'2' =>  [
											'title'  => 'JavaScript',
											'slug'  => 'javascript',
											'color' => 'green' 
								        ],
								'3' =>  [
											'title'  => 'Ruby',
											'slug'  => 'ruby',
											'color' => 'tomato'
										]
							];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	foreach($this->channels as $channel){
			App\Channel::create($channel);
		}
		$this->command->info("Channels table seeded :)");
	}
}

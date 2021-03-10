<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create([
        	'name' => 'topic1',
        ]);

        Topic::create([
        	'name' => 'topic2',
        ]);

        Topic::create([
        	'name' => 'topic3',
        ]);
    }
}

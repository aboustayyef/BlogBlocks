<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    private $lineage;
    private $list;

  /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->list = [ 
            ['columnists', 'Columnists', '#29639E'],
            ['design', 'Marketing & Design', '#EFC050'],
            ['fashion', 'Fashion & Style', '#C50161'],
            ['food', 'Food & Health', '#FF851B'],
            ['society', 'Society & Fun', '#3D9970'],
            ['politics', 'Politics & News', '#A76336'],
            ['tech', 'Tech & Business', '#6C88A0'],
            ['media', 'Music, TV & Film', '#02A7A7'],
        ];

        // Delete exisiting Tags in database to start anew
        DB::Table('tags')->truncate();

        foreach ($this->list as $item) {
            Tag::Create([
                'nickname'          =>  $item[0],
                'description'       =>  $item[1],
                'color'             =>  $item[2]
            ]);
        }
    }
}

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
        
        // Add Level one items (items with no parents)
        foreach ($this->list as $item) {
            Tag::Create([
                'nickname'          =>  $item[0],
                'description'       =>  $item[1],
                'color'             =>  $item[2]
            ]);
        }

        // Add Children
        $children =  [
            'style'       => 'fashion',
            'health'      => 'food',
            'family'      => 'society',
            'business'    => 'tech',
            'music'       => 'media',
            'tv'          => 'media',
            'film'        => 'media',
            'advertising' => 'design',
            'photography' => 'design',
            'art'         => 'design',
        ];

        foreach ($children as $child => $parent) {
            $parent_id = Tag::where('nickname', $parent)->first()->id;
            Tag::Create([
                'nickname'  =>  $child,
                'description'   =>  'Deprecated Category. Always forward to Parent',
                'parent_id' =>  $parent_id
            ]);
        }
    }
}

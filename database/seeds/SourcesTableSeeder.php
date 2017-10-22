<?php

use App\Source;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $fileLocation = database_path(). '/sources.csv';

        // Get CSV content from goods.csv in storage
        $csv = Reader::createFromPath($fileLocation);

        // Remove Headers
        $sources = collect($csv->setOffset(1)->fetchAll());

        DB::table('sources')->truncate();
        DB::table('source_tag')->truncate();

        foreach ($sources as $key => $source) {
            $result = Source::create([
                'name'              =>  trim($source[1]),
                'nickname'          =>  $source[0],
                'description'       =>  $source[2],
                'url'               =>  $source[3],
                'author'            =>  $source[4],
                'twitter'           =>  $source[5],
                'fetcher_kind'      =>  'rss',
                'fetcher_source'    =>  $source[6],
                'active'            =>  $source[9],
                'why_deactivated'   =>  $source[16]
            ]);

            // Attach Tags to Sources
            $tags = collect(explode(',', $source[7]));                  // process tag strings like "society, politics"
            $tags = $tags->filter(function($tag){                       // remove tags that don't exist in tags db
                return Tag::exists(trim($tag));
            })->map(function($tag){                                     // get the uppermost tag object: example: tv > media 
                return Tag::getByNicknameTopmost(trim($tag))->id;
            })->unique();                                               // remove duplicates
            $result->tags()->attach($tags);                             // attach
        }   
    }
}

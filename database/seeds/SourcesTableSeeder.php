<?php

use App\Source;
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
        $fileLocation = database_path(). '/blogs.csv';

        // Get CSV content from goods.csv in storage
        $csv = Reader::createFromPath($fileLocation);

        // Remove Headers
        $blogs = collect($csv->setOffset(1)->fetchAll());

        DB::table('sources')->truncate();

        foreach ($blogs as $key => $blog) {
            Source::create([
                'name'              =>  trim($blog[1]),
                'nickname'          =>  $blog[0],
                'description'       =>  $blog[2],
                'url'               =>  $blog[3],
                'author'            =>  $blog[4],
                'twitter'           =>  $blog[5],
                'fetcher_kind'      =>  'rss',
                'fetcher_source'    =>  $blog[6],
                'active'            =>  $blog[9],
                'why_deactivated'   =>  $blog[16]
            ]);
        }
    }
}

<?php

namespace App\Console\Commands;

use \DB;
use App\PostingFrequency;
use App\Source;
use Illuminate\Console\Command;

class SourceFrequencyUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lb:update_frequency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates Frequency Statistics for all the sources';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sources = Source::Where('active',1)->get();

        // Each time the stats should be resent
        DB::table('posting_frequencies')->truncate();
        $problems = collect([]);
        foreach ($sources as $key => $source) {
            $this->info("[ $source->name ]");
            $f = new PostingFrequency();
            $f->source_id = $source->id;
            $f->median = $source->calculateFrequency(50);
            $f->save();
            $this->info($f->median);
            if ($f->median == 0) {
                $problems->push($source->id . ' - ' . $source->name);
            }
        }
        $this->comment('There Was an Error in the following sources:');
        foreach ($problems as $problem) {
            $this->info($problem);
        }
    }
}

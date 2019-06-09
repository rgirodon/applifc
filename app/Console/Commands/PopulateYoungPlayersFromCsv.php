<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Player;
use App\Club;
use Carbon\Carbon;
use App\Licence;
use App\Category;

class PopulateYoungPlayersFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applifc:young {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate young players from csv files';

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
        $club = Club::find(env('DEFAULT_CLUB_ID'));
        
        $file = $this->argument('file');
        
        $this->info("Reading file : ".$file);
                
        $csv = Reader::createFromPath($file, 'r');
        
        $csv->setHeaderOffset(0);
        
        $csv->setDelimiter(';');
        
        $records = $csv->getRecords();
        
        $cpt = 0;
        
        foreach ($records as $record) {
            
            $cpt++;
            
            $this->info("Line [".$cpt."] : ".$record['lastname'].' '.$record['firstname']);
            
            
            $player = new Player();
            
            $player->club()->associate($club);
            
            $player->firstname = $record['firstname'];
            
            $player->lastname = $record['lastname'];
            
            $player->birth = Carbon::createFromFormat('d/m/Y', $record['birth']);
            
            $player->sex = 'h';
            
            $player->save();
            
            
            $category = Category::where([
                ['starts_at', '<=', $player->birth],
                ['ends_at', '>', $player->birth],
            ])->first();
            
            if ($category) {
            
                $licence = new Licence();
                
                $licence->club()->associate($club);
                
                $licence->player()->associate($player);
                                       
                $licence->category()->associate($category);
                
                $licence->starts_at = '2018-09-01';
                
                $licence->ends_at = '2019-06-30';
                
                $licence->paid = true;
                
                $licence->save();
            }
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Club;
use League\Csv\Reader;
use App\Category;
use App\Player;
use Carbon\Carbon;
use App\Licence;

class PopulateAdultPlayersFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applifc:adult {file} {category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate adult players from csv files';

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
        
        $categoryName = $this->argument('category');
        
        $category = Category::where('label', $categoryName)->first();
        
        if ($category) {
        
            $this->info("Found category : ".$category->label);
            
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
                
                $player = Player::where([
                    ['lastname', '=', $record['lastname']],
                    ['firstname', '=', $record['firstname']],
                    ['birth', '=', Carbon::createFromFormat('d/m/Y', $record['birth'])->format('Y-m-d')],
                ])->first();
                
                if (!$player) {
                    
                    $player = new Player();
                    
                    $player->club()->associate($club);
                    
                    $player->firstname = $record['firstname'];
                    
                    $player->lastname = $record['lastname'];
                    
                    $player->birth = Carbon::createFromFormat('d/m/Y', $record['birth']);
                    
                    $player->sex = 'h';
                    
                    $player->save();
                }
                
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

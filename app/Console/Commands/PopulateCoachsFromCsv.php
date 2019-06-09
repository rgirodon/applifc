<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Club;
use League\Csv\Reader;
use App\Coach;

class PopulateCoachsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applifc:coach {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate coachs from csv file';

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
            
            $coach = new Coach();
            
            $coach->club()->associate($club);
            
            $coach->firstname = $record['firstname'];
            
            $coach->lastname = $record['lastname'];
            
            $coach->email = $record['email'];
            
            $coach->password = bcrypt(env("DEFAULT_PASSWORD"));
            
            $coach->save();
        }
    }
}

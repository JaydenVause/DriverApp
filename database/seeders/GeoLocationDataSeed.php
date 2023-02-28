<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Writer;
use Log;
use App\Models\LocationData;

class GeoLocationDataSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(app_path().'/data/australian_postcodes.csv', 'r');
        $csv->setHeaderOffset(0);
        print_r($csv->getHeader());

        $records = $csv->getRecords();
        $i = 0;
        
           //  foreach($records as $record){
           //      if($i == 0){
           //          print_r ($record);
           //          $i += 1;
           //      }
           // }
        foreach ($records as $record) {
            LocationData::create([
                'postcode' => $record['postcode'],
                'suburb' => $record['locality'],
                'state' => $record['state']
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = '/var/www/html/storage/app/csv/properties.csv';
        $csv = Reader::createFromPath($file);
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        foreach ($records as $record) {
            // return false if there is no data
            if (empty($record)) return false;

            DB::table('properties')->insert(
                array(
                    'id' => $record['Id'],
                    'suburb' => $record['Suburb'],
                    'state' => $record['State'],
                    'country' => $record['Country'],
                    'guid' => (string) Str::orderedUuid(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        };
    }
}

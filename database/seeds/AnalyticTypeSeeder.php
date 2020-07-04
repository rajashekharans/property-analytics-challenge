<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class AnalyticTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = '/var/www/html/storage/app/csv/analytic_types.csv';
        $csv = Reader::createFromPath($file);
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        foreach ($records as $record) {
            // return false if there is no data
            if (empty($record)) return false;

            DB::table('analytic_types')->insert(
                array(
                    'id' => $record['id'],
                    'name' => $record['name'],
                    'units' => $record['units'],
                    'is_numeric' => strtolower($record['is_numeric']) == 'true' ? 1 : 0,
                    'num_decimal_places' => $record['num_decimal_places'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        };
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class PropertyAnalyticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = '/var/www/html/storage/app/csv/property_analytics.csv';

        $csv = Reader::createFromPath($file);

        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $record) {
            // return false if there is no data
            if (empty($record)) return false;

            DB::table('property_analytics')->insert(
                array(
                    'property_id' => $record['property_id'],
                    'analytic_type_id' => $record['analytic_type_id'],
                    'value' => $record['value'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        };
    }
}

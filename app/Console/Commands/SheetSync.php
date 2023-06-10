<?php

namespace App\Console\Commands;

use App\Models\Sheet;
use Illuminate\Console\Command;
use SheetDB\SheetDB;

class SheetSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sheet:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will SYNC the data between local DB & Google Sheet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sheetdb = new SheetDB('2zk8uiy2yhz4l');
        /**
         * Recieving and storing data to variable
         */
        $data =  $sheetdb->get();

        /**
         * Looping througn the $data 
         */
        foreach ($data as $value) {
            /**
             *  Converting $value from an 'stdObject' to 'Associative Array' to access data using keys
             */
            $v = (array)$value;
            /**
             * Saving data to Database 
             */
            $sheet = new Sheet();
            $sheet->first_name = $v['First Name'];
            $sheet->last_name = $v['Last Name'];
            $sheet->phone = $v['Phone'];
            $sheet->email = $v['Email'];
            $sheet->company_name = $v['Company Name'];
            $sheet->owner = $v['Owner'];
            $sheet->employees = $v['Employees'];
            $success = $sheet->save();
            /**
             * If data is successfully saved then delete row from google sheet
             */
            if ($success) {
                $sheetdb->delete('First Name', $v['First Name']);
            }
        }
        if ($success) {
            $this->info('Data Sync Successfull');
        }
    }
}

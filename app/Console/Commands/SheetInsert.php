<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SheetController;

class SheetInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sheet:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserting fake data into sheet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sheet = new SheetController();

        $sheet->insert();
    }
}

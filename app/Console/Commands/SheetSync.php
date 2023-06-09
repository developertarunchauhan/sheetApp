<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SheetController;

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
        $sheet = new SheetController();

        $sheet->sync();
    }
}

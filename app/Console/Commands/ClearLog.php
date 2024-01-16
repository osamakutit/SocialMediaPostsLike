<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Log;
class ClearLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clear-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command can clear all log table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::truncate();
        $this->info("Successfuly Clear Log Table");
    }
}

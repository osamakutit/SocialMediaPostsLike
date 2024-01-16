<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Information For Applications';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        
        $dbName = DB::connection()->getDatabaseName();
        $tableCount = DB::table('information_schema.tables')
            ->where('table_schema', $dbName)
            ->count();

        $tables = DB::select('SHOW Tables');
        $this->info("DB Name is: $dbName");
        $this->info("$tableCount Tables");
        $this->info("List of Tables and count rows and columns: ");
        foreach ($tables as $table) {
            $tableName = reset($table);
        
            $columns = DB::select("SHOW COLUMNS FROM $tableName");
            $numColumns = count($columns);
        
            $rowCount = DB::table($tableName)->count();
            $this->info("$tableName: ");
            $this->info("$rowCount Rows ,$numColumns Columns");

        }
    }
}

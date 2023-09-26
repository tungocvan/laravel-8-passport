<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:truncate {table}';
    protected $description = 'Truncate a database table';

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
     * @return int
     */
    public function handle()
    {
        $table = $this->argument('table');

        if ($this->confirm("Are you sure you want to truncate the {$table} table?")) {
            DB::table($table)->truncate();
            $this->info("The {$table} table has been truncated.");
        } else {
            $this->info("Table truncation canceled.");
        }
    }
}

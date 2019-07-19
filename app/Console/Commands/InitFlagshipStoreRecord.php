<?php

namespace App\Console\Commands;

use App\Models\FlagshipStoreRecord;
use Illuminate\Console\Command;

class InitFlagshipStoreRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customize:init_flagship_store_record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialzation flagship store records';

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
     * @return mixed
     */
    public function handle()
    {
        FlagshipStoreRecord::build_init_data();
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RestaurantTable;

class EnableTables extends Command
{
    protected $signature = 'tables:enable';
    protected $description = 'Enable all tables';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        RestaurantTable::query()->update(['is_enabled' => true]);
        $this->info('All tables have been enabled.');
    }
}

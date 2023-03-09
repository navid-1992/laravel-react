<?php

namespace App\Console\Commands;

use App\Traits\ApiRequests;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class RefreshData extends Command
{
    use ApiRequests;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:data-refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to refresh data';
    protected $http = 'This command is used to refresh data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $http)
    {
        parent::__construct();
        $this->http = $http;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->populateData(true);
    }
}

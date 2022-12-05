<?php

namespace App\Console\Commands;

use App\Modules\Api\CategoriesParser;
use App\Modules\Api\EndpointInfoGetter;
use Illuminate\Console\Command;

class PrepareData extends Command
{
    use CategoriesParser;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:prepare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare data from last month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $endTime = now();
        $startTime = now()->copy()->subMonth();
        $getter = new EndpointInfoGetter();
        $data = $getter->getInfo($startTime->format('Y-m-d'), $endTime->format('Y-m-d'));
        if($data !== null){
            $this->prepareInfo($data);
        }
        return 0;
    }
}

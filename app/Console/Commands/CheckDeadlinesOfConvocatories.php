<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Convocatory;

class CheckDeadlinesOfConvocatories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkdeadlines:convocatories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check convocatories and put in out of time those whose deadline is exceeded';

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
        Convocatory::where('state', 1)->whereDate('deadline', '<=', Carbon::tomorrow())->update(['state' => 2]);
        
    }
}

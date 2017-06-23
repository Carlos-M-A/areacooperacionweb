<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Offer;
use App\Http\Controllers\Offers\OfferController;

class CheckDeadlinesOfOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkdeadlines:offers';

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
        $offers = Offer::where('open', 1)->whereDate('deadline', '<=', Carbon::today())->get();
        $offerController = new OfferController();
        
        foreach ($offers as $offer) {
            $offerController->closeOffer($offer->id);
        }
        
        echo count($offers);
    }
}

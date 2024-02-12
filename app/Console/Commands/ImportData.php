<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from two json files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $firstResponse = Http::get('https://submitter.tech/test-task/endpoint1.json');
        $firstData = $firstResponse->json();

        $secondResponse = Http::get('https://submitter.tech/test-task/endpoint2.json');
        $secondData = $secondResponse->json();

        foreach ($firstData as $firstItem) {
            foreach ($secondData['data']['list'] as $secondItem) {
                if ($firstItem['name'] == $secondItem['dimensions']['ad_id']) {

                    Post::create([
                        'ad_id' => $secondItem['dimensions']['ad_id'],
                        'impressions' => $secondItem['metrics']['impressions'],
                        'clicks' => $firstItem['clicks'],
                        'unique_clicks' => $firstItem['unique_clicks'],
                        'leads' => $firstItem['leads'],
                        'conversion' => $secondItem['metrics']['conversion'],
                        'roi' => $firstItem['roi'],
                    ]);
                }
            }
        }

        $this->info('Data combined and imported successfully.');
    }

    public function calculateConversion($clicks, $leads) {
        return $leads > 0 ? ($leads / $clicks) * 100 : 0;
    }

    public function calculateROI($clicks, $leads, $impressions) {
        return $impressions > 0 ? (($leads * 100) / $impressions) - (($clicks * 100) / $impressions) : 0;
    }
}

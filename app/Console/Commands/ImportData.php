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
    $secondResponse = Http::get('https://submitter.tech/test-task/endpoint2.json');

    if (!$firstResponse->successful() || !$secondResponse->successful()) {
        $this->error('Failed to retrieve data.');
        return;
    }

    $firstData = $firstResponse->json();
    $secondData = $secondResponse->json();

    $createdPosts = [];

      array_map(function ($firstItem) use ($secondData, &$createdPosts) {
        $secondItem = collect($secondData['data']['list'])->first(function ($item) use ($firstItem) {
            return $item['dimensions']['ad_id'] == $firstItem['name'];
        });

        if ($secondItem) {
            $post = Post::create([
                'ad_id' => $secondItem['dimensions']['ad_id'],
                'impressions' => $secondItem['metrics']['impressions'],
                'clicks' => $firstItem['clicks'],
                'unique_clicks' => $firstItem['unique_clicks'],
                'leads' => $firstItem['leads'],
                'conversion' => $secondItem['metrics']['conversion'],
                'roi' => $firstItem['roi'],
            ]);
            $createdPosts[] = $post;
        }
    }, $firstData);

    $this->info('Data combined and imported successfully.');
}

}

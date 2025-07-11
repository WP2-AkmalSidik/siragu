<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchFontAwesomeIcons extends Command
{
    protected $signature   = 'fa:fetch-icons';
    protected $description = 'Download and store Font Awesome free icons as JSON';

    public function handle()
    {
        $url = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/metadata/icons.json';

        $this->info('Fetching icons...');
        $response = Http::get($url);

        if ($response->failed()) {
            $this->error('Failed to fetch icons.');
            return;
        }

        $allIcons = $response->json();

        $freeIcons = [];

        foreach ($allIcons as $name => $meta) {
            $styles = $meta['styles'];
            $isFree = collect($styles)->intersect(['solid', 'regular', 'brands'])->isNotEmpty();

            if ($isFree) {
                $freeIcons[] = [
                    'name'    => $name,
                    'label'   => $meta['label'] ?? $name,
                    'unicode' => $meta['unicode'],
                    'styles'  => $styles,
                ];
            }
        }

        Storage::disk('local')->put('fa-free-icons.json', json_encode($freeIcons, JSON_PRETTY_PRINT));

        $this->info('Saved ' . count($freeIcons) . ' free icons to storage/app/fa-free-icons.json');
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\AssetDamage;
use Filament\Widgets\BarChartWidget;
use Filament\Widgets\LineChartWidget;

class AssetDamageStats extends LineChartWidget
{
    protected static ?string $heading = 'Asset Damage Overview';

    protected function getData(): array
    {
        $damages = AssetDamage::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return [
            'labels' => $damages->keys()->toArray(),
            'datasets' => [
                [
                    'label' => 'Asset Damage Counts',
                    'data' => $damages->values()->toArray(),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)', // Colors for each status
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}

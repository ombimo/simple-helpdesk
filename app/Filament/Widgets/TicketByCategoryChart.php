<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class TicketByCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets by Category';

    protected static ?string $maxHeight = '300px';

    public static function getSort(): int
    {
        return config('widget-sort.dashboard.ticket-by-category');
    }

    protected function getData(): array
    {
        $dataCategory = Category::query()
            ->whereHas('tickets')
            ->withCount('tickets')
            ->get();

        $data = [];
        $labels = [];
        foreach ($dataCategory as $departement) {
            $data[] = $departement->tickets_count;
            $labels[] = $departement->name;
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Category',
                    'data'            => $data,
                    'backgroundColor' => [
                        '#FF6384', // Merah muda
                        '#36A2EB', // Biru terang
                        '#FFCE56', // Kuning
                        '#4BC0C0', // Hijau toska
                        '#9966FF', // Ungu
                        '#FF9F40', // Oranye
                        '#C9CBCF', // Abu muda
                        '#00A950', // Hijau tua
                        '#8E5EA2', // Ungu gelap
                        '#E7E9ED', // Abu terang
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<'JS'
        {
            responsive: true,
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }

            }
        }
    JS);
    }
}

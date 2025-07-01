<?php

namespace App\Filament\Widgets;

use App\Models\Departement;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class TicketByDepartementChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets by Departement';

    protected static ?string $maxHeight = '300px';

    public static function getSort(): int
    {
        return config('widget-sort.dashboard.ticket-by-depertement');
    }

    protected function getData(): array
    {
        $dataDepartements = Departement::query()
            ->whereHas('tickets')
            ->withCount('tickets')
            ->get();

        $data = [];
        $labels = [];
        foreach ($dataDepartements as $departement) {
            $data[] = $departement->tickets_count;
            $labels[] = $departement->name;
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Departement',
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

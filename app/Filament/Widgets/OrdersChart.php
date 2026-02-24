<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersChart extends ChartWidget
{
    protected ?string $heading = 'Orders (Last 14 Days)';

    protected function getData(): array
    {
        $data = Order::query()
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(14))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data->pluck('count'),
                ],
            ],
            'labels' => $data->pluck('date')->map(
                fn ($date) => Carbon::parse($date)->format('d M')
            ),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

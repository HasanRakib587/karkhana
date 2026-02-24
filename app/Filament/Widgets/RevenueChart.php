<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Revenue (Last 30 Days)';

    protected function getData(): array
    {
        $data = Order::query()
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(grand_total) as total')
            )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (BDT)',
                    'data' => $data->pluck('total'),
                ],
            ],
            'labels' => $data->pluck('date')->map(
                fn ($date) => Carbon::parse($date)->format('d M')
            ),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

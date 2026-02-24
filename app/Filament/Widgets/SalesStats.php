<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class SalesStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        $paidOrders = Order::where('payment_status', 'paid');

        $totalRevenue = (clone $paidOrders)->sum('grand_total');
        $monthlyRevenue = (clone $paidOrders)
            ->where('created_at', '>=', $thisMonth)
            ->sum('grand_total');

        $todayOrders = Order::whereDate('created_at', $today)->count();

        $avgOrderValue = (clone $paidOrders)->avg('grand_total') ?? 0;

        return [
            Stat::make('Total Revenue', '৳ '.number_format($totalRevenue, 2))
                ->description('All time')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Revenue This Month', '৳ '.number_format($monthlyRevenue, 2))
                ->description('Current month')
                ->color('primary'),

            Stat::make('Orders Today', $todayOrders)
                ->description('Placed today')
                ->color('warning'),

            Stat::make('Average Order Value', '৳ '.number_format($avgOrderValue, 2))
                ->description('Paid orders')
                ->color('gray'),
        ];
    }
}

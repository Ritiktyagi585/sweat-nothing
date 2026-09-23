<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display live store statistics from products and website orders.
     */
    public function index(): View
    {
        $startDate = today()->subDays(6);
        $endDate = now();
        $orderCountsByDate = Order::query()
            ->toBase()
            ->selectRaw('DATE(created_at) as order_date, COUNT(*) as order_count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupByRaw('DATE(created_at)')
            ->pluck('order_count', 'order_date');

        $orderChart = collect(range(6, 0))
            ->map(function (int $daysAgo) use ($orderCountsByDate): array {
                $date = today()->subDays($daysAgo);

                return [
                    'label' => $date->format('d M'),
                    'count' => (int) ($orderCountsByDate[$date->toDateString()] ?? 0),
                ];
            });

        $highestOrderCount = max($orderChart->max('count'), 1);
        $orderChart = $orderChart->map(function (array $day) use ($highestOrderCount): array {
            $day['height'] = max(($day['count'] / $highestOrderCount) * 100, 8);

            return $day;
        });

        $dashboardStats = [
            'todayOrders' => Order::query()->whereDate('created_at', today())->count(),
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'totalRevenue' => Order::query()->where('order_status', '!=', 'cancelled')->sum('total'),
        ];
        $recentOrders = Order::query()->latest()->take(5)->get();

        return view('dashboard.index', compact('dashboardStats', 'orderChart', 'recentOrders'));
    }
}

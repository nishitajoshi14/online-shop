<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch counts
        $totalOrders = Order::count();
        $deliveredOrders = Order::where('order_status', 'delivered')->count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $canceledOrders = Order::where('order_status', 'canceled')->count();

        // Fetch amounts
        $totalAmount = Order::sum('total');
        $deliveredAmount = Order::where('order_status', 'delivered')->sum('total');
        $pendingAmount = Order::where('order_status', 'pending')->sum('total');
        $canceledAmount = Order::where('order_status', 'canceled')->sum('total');

        // Fetch recent orders
        $recentOrders = Order::latest()->take(5)->get();

        // Prepare chart data
        $monthlyRevenue = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month');

        // Pass the data to the view
        return view('admin.dashboard', compact(
            'totalOrders',
            'deliveredOrders',
            'pendingOrders',
            'canceledOrders',
            'totalAmount',
            'deliveredAmount',
            'pendingAmount',
            'canceledAmount',
            'recentOrders',
            'monthlyRevenue'
        ));
    }

    
}

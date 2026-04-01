<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    function index(): View
    {
        $todaysOrders = Order::whereDate('created_at', Carbon::today())->sum('total_amount');
        $thisWeeksOrders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount');
        $thisMonthsOrders = Order::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_amount');
        $thisYearsOrders = Order::whereYear('created_at', Carbon::now()->year)->sum('total_amount');
        $totalOrders = Order::count();
        $pendingCourses = Course::where('is_approved', 'pending')->count();
        $rejectedCourses = Course::where('is_approved', 'rejected')->count();
        $totalCourses = Course::where('is_approved', 'approved')->count();

        $monthlyOrderSums = [];
        $monthlyOrderCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyOrderSums[] = Order::whereMonth('created_at', $month)->whereYear('created_at', Carbon::now()->year-1)->sum('total_amount');
            $monthlyOrderCounts[] = Order::whereMonth('created_at', $month)->whereYear('created_at', Carbon::now()->year-1)->count();
        }

        return view('admin.dashboard', compact('todaysOrders', 'thisWeeksOrders', 'thisMonthsOrders', 'thisYearsOrders', 'totalOrders',
            'pendingCourses', 'rejectedCourses', 'totalCourses', 'monthlyOrderSums', 'monthlyOrderCounts'));
    }
}

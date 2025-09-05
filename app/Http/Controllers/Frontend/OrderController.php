<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    function index(): View
    {
        $orderItems = OrderItem::whereHas('course', function($query) {
            $query->where('instructor_id', user()->id);
        })->paginate(12);
        //dd($orderItems);
        return view('frontend.instructor-dashboard.orders.index', compact('orderItems'));
    }
}

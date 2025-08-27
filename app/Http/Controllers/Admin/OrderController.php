<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    function index(): View
    {
        $orders = Order::with('customer')->paginate(12);
        return view('admin.order.index', compact('orders'));
    }
}

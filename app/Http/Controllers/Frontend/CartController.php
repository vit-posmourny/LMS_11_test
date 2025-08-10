<?php

namespace App\Http\Controllers\Frontend;

use render;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function index(): View
    {
        return view('frontend.pages.cart');
    }


    function addToCart(int $id): Response
    {
        if (!Auth::Guard('web')->check())
            return response(['message' => 'Please login first.'], 401);

        $cart = new Cart();

        $cart->course_id = $id;
        $cart->user_id = Auth::Guard('web')->user()->id;
        $cart->save();

        return response(['message' => 'Added to Cart Successfully.'], 200);
    }
}

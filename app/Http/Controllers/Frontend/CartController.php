<?php

namespace App\Http\Controllers\Frontend;

use render;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function index(): View
    {
        $cart = Cart::with(['course'])->where(['user_id' => user()->id])->paginate(10);
        return view('frontend.pages.cart', compact('cart'));
    }


    function addToCart(int $id): Response
    {
        if (!Auth::Guard('web')->check())
            return response(['message' => 'Please login first.'], 401);

        if (Cart::where(['course_id' => $id, 'user_id' => user()->id])->exists()) {
            return response(['message' => 'Already added.'], 401);
        }

        $cart = new Cart();
        $cart->course_id = $id;
        $cart->user_id = user()->id;
        $cart->save();
        $cartCount = cartCount();

        return response(['message' => 'Added to Cart Successfully.', 'cart_count' => $cartCount], 200);
    }


    function removeFromCart(int $itemId): RedirectResponse
    {
        $cart = Cart::where(['id' => $itemId, 'user_id' => user()->id])->firstOrFail();
        $cart->delete();

        notyf()->info('Removed from Cart Successfully.');

        return redirect()->back();
    }
}

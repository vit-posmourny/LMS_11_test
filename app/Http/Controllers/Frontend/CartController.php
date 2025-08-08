<?php

namespace App\Http\Controllers\Frontend;

use render;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function index(): View
    {
        return view('frontend.pages.cart');
    }


    function addToCart(int $id): Response
    {
        $userId = Auth::User()->id();
        $courseId = $id;

    }
}

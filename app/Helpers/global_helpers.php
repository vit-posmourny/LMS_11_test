<?php

/** convert minutes to hour and minutes */

use App\Models\Cart;

if (!function_exists('convertMinutesToHours'))
{
    function convertMinutesToHours(int $minutes): string
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;

        if ($hours == 0)
            return sprintf('%02dmin', $minutes);

        return sprintf('%dhr %02dmin', $hours, $minutes);
    }


    if (!function_exists('user'))
    {
        function user() {
            return Auth('web')->user();
        }
    }



    if (!function_exists('admin'))
    {
        function admin() {
            return Auth('admin')->user();
        }
    }



    if (!function_exists('cartTotal'))
    {
        function cartTotal()
        {
            $total = 0;
            $cartItems = Cart::where('user_id', user()->id)->get();

            foreach ($cartItems as $item) {
                if ($item->course->discount_price > 0) {
                    $total += $item->course->discount_price;
                }else {
                    $total += $item->course->price;
                }
            }
            return $total;
        }
    }



    if (!function_exists('cartCount'))
    {
        function cartCount(int $userId)
        {
            return Cart::where(['user_id' => $userId])->count();
        }
    }
}

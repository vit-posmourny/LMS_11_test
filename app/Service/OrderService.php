<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    static function storeOrder(
        string $transaction_id,
        int $buyer_id,
        string $status,
        float $total_amount,
        float $paid_amount,
        string $currency,
        string $payment_method
    ) {
        try {
            $order = new Order;
            $order->invoice_id = uniqid();
            $order->buyer_id = $buyer_id;
            $order->status = $status;
            $order->total_amount = $total_amount;
            $order->paid_amount = $paid_amount;
            $order->currency = $currency;
            $order->payment_method = $payment_method;
            $order->transaction_id = $transaction_id;
            $order->save();

            $cart = Cart::where('user_id', $buyer_id);
            $cartItems = $cart->get();
            foreach ($cartItems as $item)
            {
                // store order items //
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                if ($item->course->discount_price !== 0) {
                    $orderItem->price = $item->course->discount_price;
                } else {
                    $orderItem->price = $item->course->price;
                }
                $orderItem->course_id = $item->course->id;
                $orderItem->save();

                // store enrollments //
                $enrollment = new Enrollment();
                $enrollment->user_id = $item->user_id;
                $enrollment->course_id = $item->course_id;
                $enrollment->instructor_id = $item->course->instructor_id;
                $enrollment->save();
            }
            // delete cart items //
            $cart->delete();

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

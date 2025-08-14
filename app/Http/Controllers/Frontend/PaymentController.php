<?php

namespace App\Http\Controllers\Frontend;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    function payWithPaypal()
    {
        $provider = new PayPalClient();
        $provider->getAccessToken();

        $payableAmount = cartTotal();

        $response = $provider->createOrder([
            'intent' => "CAPTURE",
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => $payableAmount,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']))
        {
            foreach($response['links'] as $link)
            {
                if($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }
}

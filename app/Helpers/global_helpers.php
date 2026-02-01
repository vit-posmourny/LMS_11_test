<?php

/** convert minutes to hour and minutes */

use App\Models\Cart;

if (!function_exists('convertMinutesToHours'))
{
    function convertMinutesToHours(int $minutes): string
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;

        return sprintf('%dh %02dm', $hours, $minutes);
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
            $cartItems = Cart::where('user_id', @user()->id)->get();

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
        function cartCount()
        {
            return Cart::where(['user_id' => @user()->id])->count();
        }
    }



    if (!function_exists('calculateCommission'))
    {
        function calculateCommission($amount, $commission)
        {
            $result = $amount === 0 ? 0 : ($amount * $commission / 100);
            return number_format($result, 2, '.', '');
        }
    }



    if (!function_exists('tablerIcon'))
    {
        /**
         * Generate Tabler icon SVG markup
         *
         * @param string $icon Icon name (e.g., 'clock-hour-4', without 'tabler-filled-' prefix)
         * @param string $class CSS class(es) for the svg element
         * @param string $sprite Sprite type: 'filled', 'outline', or custom filename
         * @return string SVG markup
         */
        function tablerIcon(string $icon, string $class = 'icon', string $sprite = 'filled'): string
        {
            // Determine sprite file based on type
            $spriteFile = match($sprite) {
                'filled' => 'tabler-sprite-filled.svg',
                'outline' => 'tabler-sprite.svg',
                default => $sprite
            };

            $spriteUrl = asset("tabler/icons-sprite/{$spriteFile}");

            // Auto-prefix icon name if needed
            $iconId = $sprite === 'outline' ? "tabler-{$icon}" : "tabler-filled-{$icon}";

            return sprintf(
                '<svg class="%s"><use href="%s#%s"></use></svg>',
                e($class),
                e($spriteUrl),
                e($iconId)
            );
        }
    }
}

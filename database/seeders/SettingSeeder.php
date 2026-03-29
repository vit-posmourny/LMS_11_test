<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use App\Models\Setting;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
        [
            'id' => 1,
            'key' => 'site_name',
            'value' => 'Edu Core',
            'created_at' => '2025-08-30 10:11:21',
            'updated_at' => '2025-08-30 12:39:43',
        ],
        [
            'id' => 2,
            'key' => 'phone_number',
            'value' => '+420 882 133 871',
            'created_at' => '2025-08-30 10:11:21',
            'updated_at' => '2025-08-30 12:07:13',
        ],
        [
            'id' => 3,
            'key' => 'location',
            'value' => 'Autem nemo non dolor',
            'created_at' => '2025-08-30 10:11:21',
            'updated_at' => '2025-08-30 12:07:13',
        ],
        [
            'id' => 4,
            'key' => 'default_currency',
            'value' => 'USD',
            'created_at' => '2025-08-30 10:11:55',
            'updated_at' => '2025-08-30 12:39:43',
        ],
        [
            'id' => 5,
            'key' => 'currency_icon',
            'value' => '$',
            'created_at' => '2025-08-30 10:11:55',
            'updated_at' => '2025-08-30 12:39:43',
        ],
        [
            'id' => 6,
            'key' => 'commission_rate',
            'value' => '47.5',
            'created_at' => '2025-08-30 13:55:51',
            'updated_at' => '2025-08-30 13:59:29',
        ],
        [
            'id' => 7,
            'key' => 'sender_email',
            'value' => 'admin@gmail.com',
            'created_at' => '2026-01-28 23:11:29',
            'updated_at' => '2026-01-28 23:11:29',
        ],
        [
            'id' => 8,
            'key' => 'receiver_email',
            'value' => 'admin.support@gmail.com',
            'created_at' => '2026-01-28 23:11:29',
            'updated_at' => '2026-01-28 23:11:29',
        ],
        [
            'id' => 11,
            'key' => 'site_logo',
            'value' => 'uploads/educore_69c2bd941a4d8.png',
            'created_at' => '2026-03-22 21:52:30',
            'updated_at' => '2026-03-24 16:36:36',
        ],
        [
            'id' => 12,
            'key' => 'site_footer_logo',
            'value' => 'uploads/educore_69c2bd941caea.png',
            'created_at' => '2026-03-22 21:52:30',
            'updated_at' => '2026-03-24 16:36:36',
        ],
        [
            'id' => 13,
            'key' => 'site_favicon',
            'value' => 'uploads/educore_69c2bd941cf66.png',
            'created_at' => '2026-03-24 16:36:36',
            'updated_at' => '2026-03-24 16:36:36',
        ],
        [
            'id' => 14,
            'key' => 'site_breadcrumb',
            'value' => 'uploads/educore_69c2bd941e228.jpg',
            'created_at' => '2026-03-24 16:36:36',
            'updated_at' => '2026-03-24 16:36:36',
        ],
        [
            'id' => 15,
            'key' => 'mail_mailer',
            'value' => 'smtp',
            'created_at' => '2026-03-24 19:28:14',
            'updated_at' => '2026-03-24 19:28:14',
        ],
        [
            'id' => 16,
            'key' => 'mail_host',
            'value' => 'sandbox.smtp.mailtrap.io',
            'created_at' => '2026-03-24 19:28:14',
            'updated_at' => '2026-03-24 19:28:14',
        ],
        [
            'id' => 17,
            'key' => 'mail_port',
            'value' => '2525',
            'created_at' => '2026-03-24 19:28:14',
            'updated_at' => '2026-03-24 19:28:14',
        ],
        [
            'id' => 18,
            'key' => 'mail_username',
            'value' => 'fd207ecac7a023',
            'created_at' => '2026-03-24 19:28:14',
            'updated_at' => '2026-03-28 19:07:24',
        ],
        [
            'id' => 19,
            'key' => 'mail_password',
            'value' => '9741dbd76ae35d',
            'created_at' => '2026-03-24 19:28:14',
            'updated_at' => '2026-03-28 19:07:24',
        ],
        [
            'id' => 20,
            'key' => 'mail_encryption',
            'value' => 'tls',
            'created_at' => '2026-03-24 19:28:14',
            'updated_at' => '2026-03-24 19:28:14',
        ],
        [
            'id' => 21,
            'key' => 'mail_queue',
            'value' => 'true',
            'created_at' => '2026-03-24 19:28:14',
            'updated_at' => '2026-03-28 21:48:54',
        ]];

        $payment_settings = [
        [
            'id' => 1,
            'key' => 'paypal_mode',
            'value' => 'sandbox',
            'created_at' => '2025-08-18 19:21:00',
            'updated_at' => '2025-08-20 01:22:16',
        ],
        [
            'id' => 2,
            'key' => 'paypal_client_id',
            'value' => env('PAYPAL_SANDBOX_CLIENT_ID'),
            'created_at' => '2025-08-18 19:21:00',
            'updated_at' => '2025-08-20 01:25:44',
        ],
        [
            'id' => 3,
            'key' => 'paypal_client_secret',
            'value' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
            'created_at' => '2025-08-18 19:21:00',
            'updated_at' => '2025-08-24 22:58:27',
        ],
        [
            'id' => 4,
            'key' => 'paypal_currency',
            'value' => 'USD',
            'created_at' => '2025-08-18 19:21:00',
            'updated_at' => '2025-08-20 01:22:16',
        ],
        [
            'id' => 5,
            'key' => 'paypal_rate',
            'value' => '1',
            'created_at' => '2025-08-18 19:21:00',
            'updated_at' => '2025-08-20 01:25:44',
        ],
        [
            'id' => 6,
            'key' => 'paypal_app_id',
            'value' => 'App_ID',
            'created_at' => '2025-08-18 19:21:00',
            'updated_at' => '2025-08-20 01:25:44',
        ],
        [
            'id' => 13,
            'key' => 'stripe_status',
            'value' => 'active',
            'created_at' => '2025-08-24 22:51:26',
            'updated_at' => '2025-08-24 22:51:26',
        ],
        [
            'id' => 14,
            'key' => 'stripe_publishable_key',
            'value' => env('STRIPE_PUBLISHABLE_KEY'),
            'created_at' => '2025-08-24 22:51:26',
            'updated_at' => '2025-08-24 22:51:26',
        ],
        [
            'id' => 15,
            'key' => 'stripe_secret_key',
            'value' => env('STRIPE_SECRET_KEY'),
            'created_at' => '2025-08-24 22:51:26',
            'updated_at' => '2025-08-24 22:51:26',
        ],
        [
            'id' => 16,
            'key' => 'stripe_currency',
            'value' => 'USD',
            'created_at' => '2025-08-24 22:51:26',
            'updated_at' => '2025-08-24 22:51:26',
        ],
        [
            'id' => 17,
            'key' => 'stripe_rate',
            'value' => '1',
            'created_at' => '2025-08-24 22:51:26',
            'updated_at' => '2025-08-24 22:51:26',
        ],
        [
            'id' => 18,
            'key' => 'razorpay_status',
            'value' => 'active',
            'created_at' => '2025-08-25 15:41:16',
            'updated_at' => '2025-08-25 15:41:16',
        ],
        [
            'id' => 19,
            'key' => 'razorpay_key',
            'value' => env('RAZORPAY_KEY'),
            'created_at' => '2025-08-25 15:41:16',
            'updated_at' => '2025-08-25 15:52:27',
        ],
        [
            'id' => 20,
            'key' => 'razorpay_secret',
            'value' => env('RAZORPAY_SECRET'),
            'created_at' => '2025-08-25 15:41:16',
            'updated_at' => '2025-08-27 15:03:41',
        ],
        [
            'id' => 21,
            'key' => 'razorpay_currency',
            'value' => 'INR',
            'created_at' => '2025-08-25 15:41:16',
            'updated_at' => '2025-08-25 15:41:16',
        ],
        [
            'id' => 22,
            'key' => 'razorpay_rate',
            'value' => '84',
            'created_at' => '2025-08-25 15:41:16',
            'updated_at' => '2025-08-25 15:41:16',
        ]];

        // Insert the settings into the database
        Setting::insert($settings);
        PaymentSetting::insert($payment_settings);
    }
}

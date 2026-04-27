<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Midtrans\Config;
use Midtrans\Snap;

Config::$serverKey = env('MIDTRANS_SERVER_KEY');
Config::$isProduction = true;
Config::$isSanitized = true;
Config::$is3ds = true;

echo "Server Key: " . Config::$serverKey . "\n";
echo "Is Production: " . (Config::$isProduction ? 'true' : 'false') . "\n";

try {
    $token = Snap::getSnapToken([
        'transaction_details' => [
            'order_id' => 'TEST-' . time(),
            'gross_amount' => 10000,
        ],
        'customer_details' => [
            'first_name' => 'Test',
            'email' => 'test@test.com',
        ],
    ]);
    echo "SUCCESS! Token: " . $token . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach(App\Models\Billing::orderBy('id', 'desc')->take(5)->get() as $b) {
    echo $b->id . ' | ' . $b->tipe . ' | ' . $b->payment_status . ' | ' . $b->nominal . ' | ' . $b->status . "\n";
}

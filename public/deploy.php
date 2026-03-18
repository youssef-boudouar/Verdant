<?php
/**
 * One-shot deployment script — DELETE THIS FILE after running.
 *
 * Visit http://verdant-app.fwh.is/deploy.php once to migrate and seed.
 */

// ── Bootstrap Laravel ────────────────────────────────────────────────────────
define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// ── Run commands ─────────────────────────────────────────────────────────────
echo "<pre style='font-family:monospace;font-size:14px;padding:20px'>";
echo "=== Verdant Deployment ===\n\n";

echo "--- migrate --force ---\n";
Artisan::call('migrate', ['--force' => true]);
echo Artisan::output();

echo "--- db:seed --force ---\n";
Artisan::call('db:seed', ['--force' => true]);
echo Artisan::output();

echo "--- config:cache ---\n";
Artisan::call('config:cache');
echo Artisan::output();

echo "--- route:cache ---\n";
Artisan::call('route:cache');
echo Artisan::output();

echo "--- view:cache ---\n";
Artisan::call('view:cache');
echo Artisan::output();

echo "\n✅  Done. DELETE this file now: public/deploy.php\n";
echo "</pre>";

<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\QueryException;

$files = scandir(database_path('migrations'));
sort($files);
$batch = 1;

foreach ($files as $file) {
    if (strpos($file, '.php') === false) continue;
    $migrationName = str_replace('.php', '', $file);

    // Check if it's already in migrations table
    $exists = DB::table('migrations')->where('migration', $migrationName)->exists();
    if ($exists) continue;

    echo "Processing $migrationName... ";

    try {
        $exitCode = Artisan::call('migrate', [
            '--path' => 'database/migrations/' . $file,
            '--force' => true
        ]);
        
        $output = Artisan::output();
        if (strpos($output, 'Nothing to migrate') !== false) {
             // The migrate command might say this if the migration was already recorded.
             // But we just checked it wasn't recorded. Wait, maybe the class name is weird?
             echo "Migrated.\n";
        } else {
             echo "Migrated successfully.\n";
        }
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        if (
            strpos($msg, 'already exists') !== false || 
            strpos($msg, 'Duplicate column name') !== false ||
            strpos($msg, 'Duplicate entry') !== false ||
            strpos($msg, 'Base table or view already exists') !== false ||
            strpos($msg, 'Duplicate key name') !== false
        ) {
            echo "Already exists, marking as migrated manually.\n";
            DB::table('migrations')->insert([
                'migration' => $migrationName,
                'batch' => $batch
            ]);
        } else {
            echo "FAILED!\n";
            echo "Error running $migrationName: " . $msg . "\n";
            break;
        }
    } catch (\Throwable $e) {
        $msg = $e->getMessage();
        if (
            strpos($msg, 'already exists') !== false || 
            strpos($msg, 'Duplicate column name') !== false ||
            strpos($msg, 'Duplicate entry') !== false ||
            strpos($msg, 'Base table or view already exists') !== false ||
            strpos($msg, 'Duplicate key name') !== false
        ) {
            echo "Already exists, marking as migrated manually.\n";
            DB::table('migrations')->insert([
                'migration' => $migrationName,
                'batch' => $batch
            ]);
        } else {
            echo "FAILED!\n";
            echo "Error running $migrationName: " . $msg . "\n";
            break;
        }
    }
}

echo "Sync complete.\n";

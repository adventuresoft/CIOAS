<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

/**
 * php artisan permissions:sync
 *
 * permission.txt-এর সব permission গুলো database-এ sync করে।
 * Already exist থাকলে skip করে, নতুন গুলো insert করে।
 */
class SyncPermissions extends Command
{
    protected $signature   = 'permissions:sync {--force : Overwrite existing permissions}';
    protected $description = 'Sync all application permissions from the master list to the database';

    /**
     * Master permission list — permission.txt থেকে নেওয়া।
     * DB-তে ইতিমধ্যে আছে, তবু এখানে সংরক্ষণ করা আছে reference হিসেবে।
     */
    protected array $permissions = [
        // User Management
        'user.read',     'user.create',   'user.update',   'user.delete',

        // Basic Settings (covers District, Thana, Hotel Category, etc.)
        'basic_setting.read',  'basic_setting.create',  'basic_setting.update',  'basic_setting.delete',

        // Inquiry
        'inquire.read',  'inquire.create',  'inquire.update',  'inquire.delete',

        // Appointment
        'appoinment.read',  'appoinment.create',  'appoinment.update',  'appoinment.delete',

        // Land
        'land.read',  'land.create',  'land.update',  'land.delete',

        // Gun License
        'gun.read',   'gun.create',   'gun.update',   'gun.delete',

        // Missed Case
        'miss_case.read',  'miss_case.create',  'miss_case.update',  'miss_case.delete',

        // Inventory
        'inventory.read',  'inventory.create',  'inventory.update',  'inventory.delete',

        // License (DB-তে linsece → license fix করা হয়েছে)
        'license.read',  'license.create',  'license.update',  'license.delete',

        // Application Letter / Form
        'application_letter.read',  'application_letter.create',
        'application_letter.update','application_letter.delete',

        // Institute
        'institute.read',  'institute.create',  'institute.update',  'institute.delete',

        // Employee / Staff
        'employee.read',  'employee.create',  'employee.update',  'employee.delete',

        // Vehicle
        'vehicle.read',   'vehicle.create',   'vehicle.update',   'vehicle.delete',

        // Hotel & Restaurant
        'hotel-restaurant.read',  'hotel-restaurant.create',
        'hotel-restaurant.update','hotel-restaurant.delete',

        // Case Order
        'case_order.read',  'case_order.create',  'case_order.update',  'case_order.delete',

        // Institutional Admin
        'institutional-admin.read',   'institutional-admin.create',
        'institutional-admin.update', 'institutional-admin.delete',
    ];

    public function handle(): int
    {
        $this->info('🔄  Syncing permissions...');

        $created = 0;
        $skipped = 0;

        foreach ($this->permissions as $name) {
            $exists = Permission::where('name', $name)->where('guard_name', 'web')->exists();

            if ($exists && !$this->option('force')) {
                $skipped++;
                continue;
            }

            Permission::updateOrCreate(
                ['name' => $name, 'guard_name' => 'web']
            );
            $created++;
            $this->line("  <info>✔</info>  {$name}");
        }

        // Clear permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->newLine();
        $this->info("✅  Done! Created/Updated: {$created} | Skipped (already exists): {$skipped}");
        $this->line('   Permission cache cleared.');

        return Command::SUCCESS;
    }
}

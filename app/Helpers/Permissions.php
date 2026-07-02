<?php

use Illuminate\Support\Facades\Auth;

/**
 * ─────────────────────────────────────────────────────────────
 *  PERMISSION MODULE MAPPING
 * ─────────────────────────────────────────────────────────────
 *  permission.txt key  →  actual route/module slug(s)
 *
 *  employee.*          →  staff / staffs
 *  linsece.*           →  license / licenses   (DB spelling fixed)
 *  miss_case.*         →  miscase / mis_case
 *  gun.*               →  gun-license / gun_license
 *  appoinment.*        →  appointment / appointment_booking
 *  application_letter.*→  application_form / application-form
 *  inquire.*           →  inquiry / inquiries
 *  case_order.*        →  caseorder / case_order
 *  basic_setting.*     →  covers ALL basic-settings sub-modules
 * ─────────────────────────────────────────────────────────────
 */

/* ══════════════════════════════════════════════════════════════
   CORE ROLE CHECKS
══════════════════════════════════════════════════════════════ */

if (!function_exists('is_superadmin')) {
    /**
     * Admin, Superadmin or Developer — full unrestricted access.
     */
    function is_superadmin(): bool
    {
        if (!Auth::check()) return false;
        return Auth::user()->hasRole(['Admin', 'Superadmin', 'Developer']);
    }
}

if (!function_exists('is_developer')) {
    /**
     * Developer role check.
     */
    function is_developer(): bool
    {
        if (!Auth::check()) return false;
        $user = Auth::user();
        return $user->role_id == 4 || $user->hasRole('Developer');
    }
}

if (!function_exists('is_superadmin_or_developer')) {
    /**
     * Shorthand: superadmin OR developer → bypass all permission gates.
     */
    function is_superadmin_or_developer(): bool
    {
        return is_superadmin() || is_developer();
    }
}

if (!function_exists('is_institutional_admin')) {
    function is_institutional_admin(): bool
    {
        if (!Auth::check()) return false;
        $user = Auth::user();
        return in_array($user->role_id, [6, 8, 10]) ||
            $user->hasRole(['Union Admin', 'Pourashava Admin', 'City Corporation Admin']);
    }
}

/* ══════════════════════════════════════════════════════════════
   CENTRAL PERMISSION CHECK  (can_do)
══════════════════════════════════════════════════════════════ */

if (!function_exists('can_do')) {
    /**
     * Check if the authenticated user can perform $action on $module.
     *
     * Resolves module aliases so views/sidebar don't need to know
     * the exact permission string stored in the DB.
     *
     * Superadmin / Developer always returns true.
     *
     * @param  string  $module   e.g. 'staff', 'employee', 'license', 'gun'
     * @param  string  $action   read | create | update | delete
     */
    function can_do(string $module, string $action = 'read'): bool
    {
        if (is_superadmin_or_developer()) return true;
        if (!Auth::check()) return false;

        $user = Auth::user();

        // Resolve all known aliases for this module
        $candidates = _resolve_permission_candidates($module, $action);

        foreach ($candidates as $perm) {
            if ($user->can($perm)) return true;
        }

        return false;
    }
}

if (!function_exists('_resolve_permission_candidates')) {
    /**
     * Internal — build the list of permission strings to check for a module+action.
     * Handles all DB→route aliases.
     */
    function _resolve_permission_candidates(string $module, string $action): array
    {
        $m = strtolower(trim($module));

        // Map from route/view module name  →  DB permission prefix(es)
        $aliasMap = [
            // Staff / Employee
            'staff'              => ['employee'],
            'staffs'             => ['employee'],
            'employee'           => ['employee'],

            // License
            'license'            => ['license', 'linsece'],
            'licenses'           => ['license', 'linsece'],
            'linsece'            => ['license', 'linsece'],

            // Missed Case
            'miscase'            => ['miss_case'],
            'mis_case'           => ['miss_case'],
            'miss_case'          => ['miss_case'],

            // Gun License
            'gun'                => ['gun'],
            'gun-license'        => ['gun'],
            'gun_license'        => ['gun'],

            // Appointment
            'appointment'        => ['appoinment'],
            'appoinment'         => ['appoinment'],
            'appointment_booking'=> ['appoinment'],

            // Application Letter / Form
            'application_form'   => ['application_letter'],
            'application-form'   => ['application_letter'],
            'application_letter' => ['application_letter'],

            // Inquiry
            'inquiry'            => ['inquire'],
            'inquire'            => ['inquire'],
            'inquiries'          => ['inquire'],

            // Case Order
            'caseorder'          => ['case_order'],
            'case_order'         => ['case_order'],
            'case-order'         => ['case_order'],

            // Hotel & Restaurant
            'hotel-restaurant'   => ['hotel-restaurant'],
            'hotel_restaurant'   => ['hotel-restaurant'],

            // Inventory
            'inventory'          => ['inventory'],

            // Land
            'land'               => ['land'],

            // Vehicle
            'vehicle'            => ['vehicle'],
            'vehicles'           => ['vehicle'],

            // Institute
            'institute'          => ['institute'],
            'institutions'       => ['institute'],

            // Institutional Admin
            'institutional-admin'  => ['institutional-admin'],
            'institutional_admin'  => ['institutional-admin'],
            'institutionaladmin'   => ['institutional-admin'],

            // User
            'user'               => ['user'],
            'users'              => ['user'],

            // Basic Settings (parent covers all sub-modules)
            'basic_setting'      => ['basic_setting'],
            'basic-setting'      => ['basic_setting'],
            'basic_settings'     => ['basic_setting'],
        ];

        $dbPrefixes = $aliasMap[$m] ?? [$m];

        $candidates = [];
        foreach ($dbPrefixes as $prefix) {
            $candidates[] = "{$prefix}.{$action}";
        }

        return $candidates;
    }
}

/* ══════════════════════════════════════════════════════════════
   SIDEBAR MODULE ACCESS HELPERS
══════════════════════════════════════════════════════════════ */

if (!function_exists('has_module_access')) {
    /**
     * Returns true if the user has AT LEAST read or create on the module.
     * Used for showing/hiding top-level sidebar menu items.
     */
    function has_module_access(string $module): bool
    {
        if (is_superadmin_or_developer()) return true;
        if (!Auth::check()) return false;

        return can_do($module, 'read') || can_do($module, 'create');
    }
}

if (!function_exists('has_sub_module_access')) {
    /**
     * Check a specific action on a module.
     * Used for sub-menu items (Create link, List link).
     */
    function has_sub_module_access(string $module, string $action = 'read'): bool
    {
        return can_do($module, $action);
    }
}

/* ══════════════════════════════════════════════════════════════
   BASIC SETTINGS ACCESS
══════════════════════════════════════════════════════════════ */

if (!function_exists('basic_settings_view')) {
    /**
     * Can the user see the Basic Settings sidebar section at all?
     * True if they have basic_setting.read (or any action).
     */
    function basic_settings_view(): bool
    {
        if (is_superadmin_or_developer()) return true;
        return has_basic_setting_access('read')
            || has_basic_setting_access('create')
            || has_basic_setting_access('update')
            || has_basic_setting_access('delete');
    }
}

if (!function_exists('has_basic_setting_access')) {
    /**
     * basic_setting.* covers ALL sub-modules in Basic Settings.
     * (District, Thana, Hotel Category, License Category, Village, etc.)
     *
     * @param string $action  read | create | update | delete
     */
    function has_basic_setting_access(string $action = 'read'): bool
    {
        return can_do('basic_setting', $action);
    }
}

/* ══════════════════════════════════════════════════════════════
   ACCESS MANAGEMENT (Roles / Permissions / Users)
══════════════════════════════════════════════════════════════ */

if (!function_exists('access_management_permission')) {
    /**
     * Can the user see the Access Management sidebar section?
     */
    function access_management_permission(): bool
    {
        if (is_superadmin()) return true;
        if (!Auth::check()) return false;

        $user = Auth::user();
        return $user->can('user.read')
            || $user->can('users.read')
            || $user->can('roles.read')
            || $user->can('permissions.read');
    }
}

/* ══════════════════════════════════════════════════════════════
   INSTITUTE ACCESS
══════════════════════════════════════════════════════════════ */

if (!function_exists('institute_permissions')) {
    /**
     * Can the user access the Institute Settings section?
     */
    function institute_permissions(): bool
    {
        if (is_superadmin_or_developer()) return true;
        return can_do('institute', 'read') || can_do('institute', 'create');
    }
}

/* ══════════════════════════════════════════════════════════════
   BLADE / VIEW PERMISSION HELPERS
   Use these directly in Blade templates for button visibility.
══════════════════════════════════════════════════════════════ */

if (!function_exists('user_can_read')) {
    /** Show list table and view page only. */
    function user_can_read(string $module): bool  { return can_do($module, 'read'); }
}

if (!function_exists('user_can_create')) {
    /** Show create form / create button. */
    function user_can_create(string $module): bool { return can_do($module, 'create'); }
}

if (!function_exists('user_can_update')) {
    /** Show edit / update button. */
    function user_can_update(string $module): bool { return can_do($module, 'update'); }
}

if (!function_exists('user_can_delete')) {
    /**
     * Show delete, approve, final-approve buttons.
     * (delete permission covers approval actions as per requirement)
     */
    function user_can_delete(string $module): bool { return can_do($module, 'delete'); }
}

/* ══════════════════════════════════════════════════════════════
   LEGACY / ROUTE-GUESS HELPER (kept for backward compatibility)
══════════════════════════════════════════════════════════════ */

if (!function_exists('get_current_module')) {
    function get_current_module($module = null)
    {
        if (!empty($module)) {
            return strtolower($module);
        }

        $routeName = request()->route() ? request()->route()->getName() : '';
        $uri       = request()->route() ? request()->route()->uri() : '';

        $checks = [
            'people'      => ['people'],
            'certificates'=> ['certificate'],
            'institutions'=> ['institute'],
            'trades'      => ['trade', 'organization'],
            'taxes'       => ['tax'],
            'houses'      => ['house'],
            'lands'       => ['land'],
            'vehicles'    => ['vehicle'],
            'roads'       => ['road', 'bridge', 'market'],
            'marriages'   => ['marriage'],
            'divorces'    => ['divorce'],
            'roles'       => ['role'],
            'permissions' => ['permission'],
            'users'       => ['user'],
        ];

        foreach ($checks as $result => $keywords) {
            foreach ($keywords as $kw) {
                if (str_contains($routeName, $kw) || str_contains($uri, $kw)) {
                    return $result;
                }
            }
        }

        return 'people';
    }
}

/* ══════════════════════════════════════════════════════════════
   BACKWARD-COMPATIBLE LEGACY FUNCTIONS
   পুরনো views গুলো এই function নামগুলো ব্যবহার করে।
   এগুলো current route/URL থেকে module detect করে can_do() call করে।
   Views পরিবর্তন না করেই সব কাজ করবে।
══════════════════════════════════════════════════════════════ */

if (!function_exists('_detect_module_from_route')) {
    /**
     * Current route/URL থেকে module name detect করে।
     * Permission.txt-এর DB key গুলো return করে।
     */
    function _detect_module_from_route(): string
    {
        $routeName = request()->route() ? request()->route()->getName() : '';
        $uri       = request()->route() ? request()->route()->uri() : '';

        $map = [
            // Staff (employee permission)
            'employee'           => ['staff', 'staffapproved', 'leave-application', 'leave_application'],
            // License
            'license'            => ['license'],
            // Hotel & Restaurant
            'hotel-restaurant'   => ['hotel-restaurant', 'hotel_restaurant'],
            // Vehicle
            'vehicle'            => ['vehicle'],
            // Institute
            'institute'          => ['institute'],
            // Land
            'land'               => ['land'],
            // Gun License
            'gun'                => ['gun-license', 'gun_license', 'gun'],
            // Missed Case
            'miss_case'          => ['miscase', 'mis-case', 'mis_case'],
            // Case Order
            'case_order'         => ['caseorder', 'case-order', 'case_order'],
            // Inventory
            'inventory'          => ['inventory'],
            // Inquiry
            'inquire'            => ['inquiry', 'inquir'],
            // Appointment
            'appoinment'         => ['appointment'],
            // Application Letter
            'application_letter' => ['application-form', 'application_form'],
            // User
            'user'               => ['user'],
            // Institutional Admin
            'institutional-admin'=> ['institutional-admin', 'institutional_admin'],
            // People (no dedicated permission, treat as superadmin-only)
            'people'             => ['people', 'certificate', 'house', 'road', 'marriage',
                                     'divorce', 'tax', 'trade', 'organization', 'succession'],
        ];

        foreach ($map as $permission => $keywords) {
            foreach ($keywords as $kw) {
                if (str_contains($routeName, $kw) || str_contains($uri, $kw)) {
                    return $permission;
                }
            }
        }

        return 'people';
    }
}

if (!function_exists('create_permission')) {
    /**
     * Legacy: পুরনো views-এ create_permission() call হয়।
     * Current page-এর module detect করে employee.create etc. check করে।
     * Optional $module parameter দিলে সেটা ব্যবহার করবে।
     */
    function create_permission(?string $module = null): bool
    {
        if (is_superadmin_or_developer()) return true;
        $m = $module ?? _detect_module_from_route();
        // 'people' module-এর জন্য superadmin/developer only
        if ($m === 'people') return is_superadmin_or_developer();
        return can_do($m, 'create');
    }
}

if (!function_exists('view_permission')) {
    /**
     * Legacy: পুরনো views-এ view_permission() call হয়।
     * .read permission check করে।
     */
    function view_permission(?string $module = null): bool
    {
        if (is_superadmin_or_developer()) return true;
        $m = $module ?? _detect_module_from_route();
        if ($m === 'people') return is_superadmin_or_developer();
        return can_do($m, 'read');
    }
}

if (!function_exists('update_permission')) {
    /**
     * Legacy: পুরনো views-এ update_permission() call হয়।
     * .update permission check করে।
     */
    function update_permission(?string $module = null): bool
    {
        if (is_superadmin_or_developer()) return true;
        $m = $module ?? _detect_module_from_route();
        if ($m === 'people') return is_superadmin_or_developer();
        return can_do($m, 'update');
    }
}

if (!function_exists('delete_permission')) {
    /**
     * Legacy: পুরনো views-এ delete_permission() call হয়।
     * .delete permission check করে।
     */
    function delete_permission(?string $module = null): bool
    {
        if (is_superadmin_or_developer()) return true;
        $m = $module ?? _detect_module_from_route();
        if ($m === 'people') return is_superadmin_or_developer();
        return can_do($m, 'delete');
    }
}

if (!function_exists('approve_permission')) {
    /**
     * Legacy: approve / final-approve গুলো delete permission দিয়ে control হয়।
     */
    function approve_permission(?string $module = null): bool
    {
        return delete_permission($module);
    }
}

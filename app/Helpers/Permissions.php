<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('get_current_module')) {
    function get_current_module($module = null)
    {
        if (!empty($module)) {
            return strtolower($module);
        }

        // Guess the module name from current route or URL
        $routeName = request()->route() ? request()->route()->getName() : '';
        $uri = request()->route() ? request()->route()->uri() : '';

        if (str_contains($routeName, 'people') || str_contains($uri, 'people')) {
            return 'people';
        }
        if (str_contains($routeName, 'certificate') || str_contains($uri, 'certificate')) {
            return 'certificates';
        }
        if (str_contains($routeName, 'institute') || str_contains($uri, 'institute')) {
            return 'institutions';
        }
        if (str_contains($routeName, 'trade') || str_contains($routeName, 'organization') || str_contains($uri, 'trade') || str_contains($uri, 'organization')) {
            return 'trades';
        }
        if (str_contains($routeName, 'tax') || str_contains($uri, 'tax')) {
            return 'taxes';
        }
        if (str_contains($routeName, 'house') || str_contains($uri, 'house')) {
            return 'houses';
        }
        if (str_contains($routeName, 'land') || str_contains($uri, 'land')) {
            return 'lands';
        }
        if (str_contains($routeName, 'vehicle') || str_contains($uri, 'vehicle')) {
            return 'vehicles';
        }
        if (
            str_contains($routeName, 'road') || str_contains($routeName, 'bridge') || str_contains($routeName, 'market') ||
            str_contains($uri, 'road') || str_contains($uri, 'bridge') || str_contains($uri, 'market')
        ) {
            return 'roads';
        }
        if (str_contains($routeName, 'marriage') || str_contains($uri, 'marriage')) {
            return 'marriages';
        }
        if (str_contains($routeName, 'divorce') || str_contains($uri, 'divorce')) {
            return 'divorces';
        }
        if (str_contains($routeName, 'role') || str_contains($uri, 'role')) {
            return 'roles';
        }
        if (str_contains($routeName, 'permission') || str_contains($uri, 'permission')) {
            return 'permissions';
        }
        if (str_contains($routeName, 'user') || str_contains($uri, 'user')) {
            return 'users';
        }

        return 'people';
    }
}

if (!function_exists('is_superadmin')) {
    function is_superadmin()
    {
        if (!Auth::check()) {
            return false;
        }
        $user = Auth::user();
        return $user->hasRole(['Admin', 'Developer']);
    }
}

if (!function_exists('is_developer')) {
    function is_developer()
    {
        if (!Auth::check()) {
            return false;
        }
        $user = Auth::user();
        return $user->role_id == 4 || $user->hasRole('Developer');
    }
}

if (!function_exists('is_institutional_admin')) {
    function is_institutional_admin()
    {
        if (!Auth::check()) {
            return false;
        }
        $user = Auth::user();
        return in_array($user->role_id, [6, 8, 10]) || $user->hasRole(['Union Admin', 'Pourashava Admin', 'City Corporation Admin']);
    }
}

if (!function_exists('create_permission')) {
    function create_permission($module = null)
    {
        if (is_developer()) {
            return true;
        }
        if (!Auth::check()) {
            return false;
        }
        $mod = get_current_module($module);
        return Auth::user()->can("$mod.create");
    }
}

if (!function_exists('edit_permission')) {
    function edit_permission($module = null)
    {
        if (is_developer()) {
            return true;
        }
        if (!Auth::check()) {
            return false;
        }
        $mod = get_current_module($module);
        return Auth::user()->can("$mod.update");
    }
}

if (!function_exists('view_permission')) {
    function view_permission($module = null)
    {
        if (is_developer()) {
            return true;
        }
        if (!Auth::check()) {
            return false;
        }
        $mod = get_current_module($module);
        return Auth::user()->can("$mod.read");
    }
}

if (!function_exists('delete_permission')) {
    function delete_permission($module = null)
    {
        if (is_developer()) {
            return true;
        }
        if (!Auth::check()) {
            return false;
        }
        $mod = get_current_module($module);
        return Auth::user()->can("$mod.delete");
    }
}

if (!function_exists('basic_settings_permissions')) {
    function basic_settings_permissions()
    {
        return is_developer() || (Auth::check() && Auth::user()->can('basic_settings.read'));
    }
}

if (!function_exists('institute_permissions')) {
    function institute_permissions()
    {
        return is_developer() || (Auth::check() && Auth::user()->can('institutions.read'));
    }
}

if (!function_exists('access_management_permission')) {
    function access_management_permission()
    {
        return is_superadmin() || (Auth::check() && (
            Auth::user()->can('roles.read') ||
            Auth::user()->can('permissions.read') ||
            Auth::user()->can('users.read')
        ));
    }
}

if (!function_exists('has_module_access')) {
    function has_module_access($module)
    {
        if (is_developer()) {
            return true;
        }
        if (!Auth::check()) {
            return false;
        }
        $moduleSnake = str_replace('-', '_', $module);
        $moduleKebab = str_replace('_', '-', $module);

        return Auth::user()->can("$module.read") ||
            Auth::user()->can("$moduleSnake.read") ||
            Auth::user()->can("$moduleKebab.read") ||
            Auth::user()->can("$module.create") ||
            Auth::user()->can("$moduleSnake.create") ||
            Auth::user()->can("$moduleKebab.create");
    }
}

if (!function_exists('has_sub_module_access')) {
    function has_sub_module_access($module, $action = 'read')
    {
        if (is_developer()) {
            return true;
        }
        if (!Auth::check()) {
            return false;
        }
        $moduleSnake = str_replace('-', '_', $module);
        $moduleKebab = str_replace('_', '-', $module);

        return Auth::user()->can("$module.$action") ||
            Auth::user()->can("$moduleSnake.$action") ||
            Auth::user()->can("$moduleKebab.$action");
    }
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckModulePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_superadmin_or_developer()) {
            return $next($request);
        }

        $routeName = $request->route() ? $request->route()->getName() : '';
        $uri = $request->route() ? $request->route()->uri() : '';

        // Allow basic dashboard, auth, and common routes
        $allowedRoutes = [
            'dashboard',
            'logout',
            'profile',
            'profile.update',
            'projectTypeContent',
            'backendProjectTypeContent'
        ];

        if (in_array($routeName, $allowedRoutes)) {
            return $next($request);
        }

        // Detect module from route using legacy helper function
        $module = _detect_module_from_route();

        // Determine action based on method, route name, and uri
        $method = $request->method();
        $action = 'read';

        if (str_ends_with($routeName, '.records') || str_contains($uri, '/records')) {
            $action = 'read';
        } elseif (str_contains($routeName, 'approve') || str_contains($routeName, 'reject') || str_contains($uri, '/approve') || str_contains($uri, '/reject')) {
            $action = 'delete';
        } elseif (in_array($method, ['POST'])) {
            $action = 'create';
        } elseif (in_array($method, ['PUT', 'PATCH'])) {
            $action = 'update';
        } elseif (in_array($method, ['DELETE'])) {
            $action = 'delete';
        } else {
            if (str_ends_with($routeName, '.create') || str_ends_with($routeName, '.apply') || str_contains($uri, '/create') || str_contains($uri, '/apply')) {
                $action = 'create';
            } elseif (str_ends_with($routeName, '.edit') || str_contains($uri, '/edit')) {
                $action = 'update';
            } elseif (str_ends_with($routeName, '.destroy') || str_contains($uri, '/delete')) {
                $action = 'delete';
            }
        }

        // Handle 'people' fallback logic
        if ($module === 'people') {
            $legacyKeywords = ['people', 'certificate', 'house', 'road', 'marriage', 'divorce', 'tax', 'trade', 'organization', 'succession', 'chairman', 'councilor'];
            $isLegacy = false;
            foreach ($legacyKeywords as $kw) {
                if (str_contains($routeName, $kw) || str_contains($uri, $kw)) {
                    $isLegacy = true;
                    break;
                }
            }
            
            // If it's a known legacy route, enforce superadmin/developer only (since it's not superadmin, block)
            if ($isLegacy) {
                abort(403, 'Unauthorized action. Superadmin or Developer only.');
            }
            
            // For unmapped/unknown routes that fall back to 'people', allow them to proceed 
            // so we don't break unrelated backend features (like ajax dropdowns).
            return $next($request);
        }

        // Check permission using the existing can_do helper function
        if (can_do($module, $action)) {
            return $next($request);
        }

        abort(403, 'User does not have the right permissions for module: ' . $module . ' (Action: ' . $action . ')');
    }
}

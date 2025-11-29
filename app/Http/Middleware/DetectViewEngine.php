<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectViewEngine
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If dual mode is disabled, proceed normally
        if (! config('migration.dual_mode')) {
            return $next($request);
        }

        // Get the current route name
        $routeName = $request->route()?->getName();

        // Check if this route has been migrated to Blade
        $migratedRoutes = config('migration.migrated_routes', []);
        $isMigrated = isset($migratedRoutes[$routeName]) && $migratedRoutes[$routeName];

        // Store the engine type in the request for controllers to use
        $request->attributes->set('view_engine', $isMigrated ? 'blade' : 'inertia');

        return $next($request);
    }
}

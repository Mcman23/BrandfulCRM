<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Role;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();
        if (!$user) {
            abort(403, 'Bu səhifəyə giriş icazəniz yoxdur.');
        }
        $userRole = $user->role;
        $allowedRoles = array_map(fn($r) => Role::from($r), $roles);
        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Bu əməliyyat üçün icazəniz yoxdur.');
        }
        return $next($request);
    }
}


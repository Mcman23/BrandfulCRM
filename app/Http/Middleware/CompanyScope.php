<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyScope
{
    public function handle(Request $request, Closure $next): Response
    {
        $companyId = $request->query('company_id') ?? session('selected_company_id');
        if ($companyId) {
            session(['selected_company_id' => $companyId]);
        }
        return $next($request);
    }
}


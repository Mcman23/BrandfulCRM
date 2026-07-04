<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyFilterController extends Controller
{
    public function set(Request $request)
    {
        session(['selected_company_id' => $request->company_id ?: null]);
        return redirect()->back();
    }
}


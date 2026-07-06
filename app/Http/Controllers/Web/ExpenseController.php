<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\Deal;
use App\Models\Company;

class ExpenseController extends Controller
{
    public function index()
    {
        $companyId = session('selected_company_id');

        $query = Expense::with(['company:id,company_name', 'deal:id,client_id,amount', 'deal.client:id,client_name']);
        if ($companyId) $query->where('company_id', $companyId);
        $expenses = $query->orderBy('expense_date', 'desc')->get();

        $totalExpenses = (float) $expenses->sum('amount');

        $dealsQuery = Deal::with('client:id,client_name');
        if ($companyId) {
            $dealsQuery->whereHas('client', fn($q) => $q->where('company_id', $companyId));
        }
        $deals = $dealsQuery->orderBy('created_at', 'desc')->get();

        $companies = Company::orderBy('company_name')->get();

        return view('expenses', compact('expenses', 'totalExpenses', 'deals', 'companies'));
    }

    public function store(ExpenseRequest $request)
    {
        Expense::create($request->validated());
        return redirect()->route('expenses')->with('success', 'Xərc qeydə alındı');
    }

    public function update(ExpenseRequest $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->update($request->validated());
        return redirect()->route('expenses')->with('success', 'Xərc yeniləndi');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return redirect()->route('expenses')->with('success', 'Xərc silindi');
    }
}

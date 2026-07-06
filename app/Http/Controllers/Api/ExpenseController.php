<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with(['company:id,company_name', 'deal']);
        if ($request->has('company_id')) $query->where('company_id', $request->company_id);
        if ($request->has('deal_id')) $query->where('deal_id', $request->deal_id);
        return response()->json($query->orderBy('expense_date', 'desc')->get());
    }

    public function show($id)
    {
        return response()->json(Expense::with(['company', 'deal'])->findOrFail($id));
    }

    public function store(ExpenseRequest $request)
    {
        return response()->json(Expense::create($request->validated()), 201);
    }

    public function update(ExpenseRequest $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->update($request->validated());
        return response()->json($expense);
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json(['message' => 'Xərc silindi']);
    }
}

@extends('layouts.app')
@section('title', 'Xərclər')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div><h1 class="text-2xl font-bold">Xərclər</h1><p class="text-sm text-muted-foreground">Hər bir iş üzrə xərcləri qeyd edin</p></div>
        <button onclick="openExpenseModal()" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm font-medium hover:bg-primary/90">+ Yeni xərc</button>
    </div>

    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg border bg-card shadow-sm p-4">
            <p class="text-sm text-muted-foreground">Ümumi xərc</p>
            <p class="text-2xl font-bold text-destructive">{{ number_format($totalExpenses, 2) }} AZN</p>
        </div>
        <div class="rounded-lg border bg-card shadow-sm p-4">
            <p class="text-sm text-muted-foreground">Qeyd sayı</p>
            <p class="text-2xl font-bold">{{ $expenses->count() }}</p>
        </div>
        <div class="rounded-lg border bg-card shadow-sm p-4">
            <p class="text-sm text-muted-foreground">Əlaqəli işlər</p>
            <p class="text-2xl font-bold">{{ $expenses->pluck('deal_id')->filter()->unique()->count() }}</p>
        </div>
    </div>

    <div class="rounded-lg border bg-card shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="border-b">
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Tarix</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Ad</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Kateqoriya</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">İş (Deal)</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Şirkət</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Məbləğ</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Əməliyyat</th>
            </tr></thead>
            <tbody>
                @forelse ($expenses as $e)
                <tr class="border-b hover:bg-muted/50">
                    <td class="p-4 whitespace-nowrap">{{ $e->expense_date->format('d.m.Y') }}</td>
                    <td class="p-4 font-medium">{{ $e->title }}</td>
                    <td class="p-4"><span class="text-xs border px-2 py-0.5 rounded-full whitespace-nowrap">{{ $e->category->label() }}</span></td>
                    <td class="p-4 text-sm text-muted-foreground whitespace-nowrap">{{ $e->deal?->client?->client_name ?? '—' }}</td>
                    <td class="p-4 text-sm text-muted-foreground whitespace-nowrap">{{ $e->company->company_name ?? '—' }}</td>
                    <td class="p-4 font-semibold text-destructive whitespace-nowrap">{{ number_format($e->amount, 2) }} AZN</td>
                    <td class="p-4"><div class="flex gap-1">
                        <button onclick='editExpense({{ json_encode($e->toArray()) }})' class="p-2 hover:bg-accent rounded-md">✏️</button>
                        <form action="{{ route('expenses') }}/{{ $e->id }}" method="POST" onsubmit="return confirm('Xərci silmək istədiyinizə əminsiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 hover:bg-accent rounded-md">🗑️</button>
                        </form>
                    </div></td>
                </tr>
                @empty
                <tr><td colspan="7" class="p-8 text-center text-muted-foreground">Hələ heç bir xərc qeydə alınmayıb</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="expenseModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeExpenseModal()"></div>
    <div class="relative z-50 w-full max-w-2xl rounded-lg bg-card p-6 shadow-lg max-h-[90vh] overflow-y-auto m-4">
        <h2 id="expenseModalTitle" class="text-xl font-bold mb-4">Yeni xərc</h2>
        <form id="expenseForm" method="POST" action="{{ route('expenses') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" id="ef_method" value="">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium">Şirkət</label>
                    <select name="company_id" id="ef_company" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1">
                        @foreach ($companies as $c)
                            <option value="{{ $c->id }}">{{ $c->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium">İş (Deal) - istəyə bağlı</label>
                    <select name="deal_id" id="ef_deal" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1">
                        <option value="">Ümumi xərc (işə bağlı deyil)</option>
                        @foreach ($deals as $d)
                            <option value="{{ $d->id }}">{{ $d->client->client_name ?? 'Naməlum' }} — {{ number_format($d->amount, 2) }} AZN</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium">Xərcin adı</label>
                    <input name="title" id="ef_title" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" />
                </div>
                <div>
                    <label class="text-sm font-medium">Kateqoriya</label>
                    <select name="category" id="ef_category" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1">
                        <option value="NEQLIYYAT">Nəqliyyat</option>
                        <option value="MATERIAL">Material</option>
                        <option value="EMEK_HAQQI">Əmək haqqı</option>
                        <option value="MARKETINQ">Marketinq</option>
                        <option value="ICARE">İcarə</option>
                        <option value="DIGER">Digər</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium">Məbləğ (AZN)</label>
                    <input name="amount" id="ef_amount" type="number" step="0.01" min="0" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" />
                </div>
                <div>
                    <label class="text-sm font-medium">Tarix</label>
                    <input name="expense_date" id="ef_date" type="date" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" />
                </div>
            </div>
            <div><label class="text-sm font-medium">Qeydlər</label><textarea name="notes" id="ef_notes" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1"></textarea></div>
            <div class="flex gap-2 justify-end"><button type="button" onclick="closeExpenseModal()" class="h-10 px-4 rounded-md border text-sm">Ləğv et</button><button type="submit" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm">Yadda saxla</button></div>
        </form>
    </div>
</div>
<script>
function openExpenseModal() {
    document.getElementById('expenseModalTitle').textContent = 'Yeni xərc';
    document.getElementById('expenseForm').action = '{{ route("expenses") }}';
    document.getElementById('ef_method').value = '';
    ['ef_title','ef_amount','ef_notes','ef_deal'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('ef_category').value = 'DIGER';
    document.getElementById('ef_date').value = new Date().toISOString().split('T')[0];
    document.getElementById('expenseModal').classList.remove('hidden');
}
function editExpense(e) {
    document.getElementById('expenseModalTitle').textContent = 'Xərci redaktə et';
    document.getElementById('expenseForm').action = '{{ route("expenses") }}/' + e.id;
    document.getElementById('ef_method').value = 'PUT';
    document.getElementById('ef_company').value = e.company_id;
    document.getElementById('ef_deal').value = e.deal_id || '';
    document.getElementById('ef_title').value = e.title;
    document.getElementById('ef_category').value = e.category;
    document.getElementById('ef_amount').value = e.amount;
    document.getElementById('ef_date').value = e.expense_date ? e.expense_date.split('T')[0] : '';
    document.getElementById('ef_notes').value = e.notes || '';
    document.getElementById('expenseModal').classList.remove('hidden');
}
function closeExpenseModal() { document.getElementById('expenseModal').classList.add('hidden'); }
</script>
@endsection

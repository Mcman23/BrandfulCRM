@extends('layouts.app')
@section('title', 'Xidmətlər')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div><h1 class="text-2xl font-bold">Xidmətlər</h1><p class="text-sm text-muted-foreground">Təklif olunan xidmətlər</p></div>
        <button onclick="openServiceModal()" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm font-medium hover:bg-primary/90">+ Yeni xidmət</button>
    </div>
    <div class="rounded-lg border bg-card shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="border-b">
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Ad</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Təsvir</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Qiymət</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Şirkət</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Lead</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Əməliyyat</th>
            </tr></thead>
            <tbody>
                @foreach ($services as $s)
                <tr class="border-b hover:bg-muted/50">
                    <td class="p-4 font-medium">{{ $s->name }}</td>
                    <td class="p-4 text-sm text-muted-foreground">{{ $s->description ?: '—' }}</td>
                    <td class="p-4 font-semibold">{{ number_format($s->price, 2) }} AZN</td>
                    <td class="p-4 text-sm">{{ $s->company->company_name ?? '—' }}</td>
                    <td class="p-4"><span class="text-xs bg-secondary px-2 py-0.5 rounded-full">{{ $s->leads_count }}</span></td>
                    <td class="p-4"><div class="flex gap-1">
                        <button onclick='editService({{ json_encode($s->toArray()) }})' class="p-2 hover:bg-accent rounded-md">✏️</button>
                        <form action="{{ route('services') }}/{{ $s->id }}" method="POST" onsubmit="return confirm('Sil?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 hover:bg-accent rounded-md">🗑️</button>
                        </form>
                    </div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="serviceModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeServiceModal()"></div>
    <div class="relative z-50 w-full max-w-lg rounded-lg bg-card p-6 shadow-lg m-4">
        <h2 id="serviceModalTitle" class="text-xl font-bold mb-4">Yeni xidmət</h2>
        <form id="serviceForm" method="POST" action="{{ route('services') }}" class="space-y-4">
            @csrf <input type="hidden" name="_method" id="serviceMethod" value="">
            <input type="hidden" name="company_id" id="sf_company">
            <div><label class="text-sm font-medium">Ad</label><input name="name" id="sf_name" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Təsvir</label><textarea name="description" id="sf_desc" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1"></textarea></div>
            <div><label class="text-sm font-medium">Qiymət (AZN)</label><input name="price" id="sf_price" type="number" step="0.01" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div class="flex gap-2 justify-end"><button type="button" onclick="closeServiceModal()" class="h-10 px-4 rounded-md border text-sm">Ləğv et</button><button type="submit" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm">Yarat</button></div>
        </form>
    </div>
</div>
<script>
function openServiceModal() {
    document.getElementById('serviceModalTitle').textContent = 'Yeni xidmət';
    document.getElementById('serviceForm').action = '{{ route("services") }}';
    document.getElementById('serviceMethod').value = '';
    document.getElementById('sf_company').value = '{{ $companies->first()->id ?? "" }}';
    ['sf_name','sf_desc','sf_price'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('serviceModal').classList.remove('hidden');
}
function editService(s) {
    document.getElementById('serviceModalTitle').textContent = 'Redaktə';
    document.getElementById('serviceForm').action = '{{ route("services") }}/' + s.id;
    document.getElementById('serviceMethod').value = 'PUT';
    document.getElementById('sf_company').value = s.company_id;
    document.getElementById('sf_name').value = s.name;
    document.getElementById('sf_desc').value = s.description || '';
    document.getElementById('sf_price').value = s.price;
    document.getElementById('serviceModal').classList.remove('hidden');
}
function closeServiceModal() { document.getElementById('serviceModal').classList.remove('hidden'); }
</script>
@endsection

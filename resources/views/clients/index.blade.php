@extends('layouts.app')
@section('title', 'Müştərilər')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div><h1 class="text-2xl font-bold">Müştərilər</h1><p class="text-sm text-muted-foreground">{{ $clients->total() }} müştəri</p></div>
        <button onclick="openClientModal()" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm font-medium hover:bg-primary/90">+ Yeni müştəri</button>
    </div>
    <form method="GET" action="{{ route('clients.index') }}" class="flex gap-3 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Müştəri axtar..." class="flex h-10 flex-1 min-w-[200px] rounded-md border border-input bg-background px-3 py-2 text-sm" />
        <select name="industry" class="flex h-10 w-40 rounded-md border border-input bg-background px-3 py-2 text-sm">
            <option value="">Bütün sahələr</option>
            <option value="İT" @if(request('industry')==='İT') selected @endif>İT</option>
            <option value="Ticarət" @if(request('industry')==='Ticarət') selected @endif>Ticarət</option>
            <option value="Səhiyyə" @if(request('industry')==='Səhiyyə') selected @endif>Səhiyyə</option>
            <option value="Gözəllik" @if(request('industry')==='Gözəllik') selected @endif>Gözəllik</option>
            <option value="Avtomobil" @if(request('industry')==='Avtomobil') selected @endif>Avtomobil</option>
            <option value="Logistika" @if(request('industry')==='Logistika') selected @endif>Logistika</option>
        </select>
        <button type="submit" class="h-10 px-4 rounded-md border text-sm">Axtar</button>
    </form>
    <div class="rounded-lg border bg-card shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="border-b">
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Müştəri</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Şirkət</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Telefon</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Sahə</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Şirkət</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Əməliyyatlar</th>
            </tr></thead>
            <tbody>
                @foreach ($clients as $c)
                <tr class="border-b hover:bg-muted/50">
                    <td class="p-4 font-medium"><a href="{{ route('clients.show', $c->id) }}" class="hover:text-primary">{{ $c->client_name }}</a></td>
                    <td class="p-4">{{ $c->client_company_name ?: '—' }}</td>
                    <td class="p-4">{{ $c->phone ?: '—' }}</td>
                    <td class="p-4">{!! $c->industry ? '<span class="text-xs border px-2 py-0.5 rounded-full whitespace-nowrap">'.e($c->industry).'</span>' : '—' !!}</td>
                    <td class="p-4 text-sm text-muted-foreground">{{ $c->company->company_name ?? '—' }}</td>
                    <td class="p-4"><div class="flex gap-1">
                        <a href="{{ route('clients.show', $c->id) }}" class="p-2 hover:bg-accent rounded-md">👁️</a>
                        <button onclick='editClient({{ json_encode($c->toArray()) }})' class="p-2 hover:bg-accent rounded-md">✏️</button>
                        <form action="{{ route('clients.index') }}/{{ $c->id }}" method="POST" onsubmit="return confirm('Müştərini silmək istədiyinizə əminsiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 hover:bg-accent rounded-md">🗑️</button>
                        </form>
                    </div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $clients->links() }}
</div>

<!-- Modal -->
<div id="clientModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeClientModal()"></div>
    <div class="relative z-50 w-full max-w-2xl rounded-lg bg-card p-6 shadow-lg max-h-[90vh] overflow-y-auto m-4">
        <h2 id="clientModalTitle" class="text-xl font-bold mb-4">Yeni müştəri</h2>
        <form id="clientForm" method="POST" action="{{ route('clients.index') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" id="clientMethod" value="">
            <input type="hidden" name="company_id" id="cf_company">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><label class="text-sm font-medium">Müştəri adı</label><input name="client_name" id="cf_name" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
                <div><label class="text-sm font-medium">Şirkət adı</label><input name="client_company_name" id="cf_cname" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
                <div><label class="text-sm font-medium">Telefon</label><input name="phone" id="cf_phone" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
                <div><label class="text-sm font-medium">WhatsApp</label><input name="whatsapp" id="cf_wa" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
                <div><label class="text-sm font-medium">Email</label><input name="email" type="email" id="cf_email" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
                <div><label class="text-sm font-medium">Sahə</label><input name="industry" id="cf_ind" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            </div>
            <div><label class="text-sm font-medium">Ünvan</label><input name="address" id="cf_addr" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Qeydlər</label><textarea name="notes" id="cf_notes" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1"></textarea></div>
            <div class="flex gap-2 justify-end"><button type="button" onclick="closeClientModal()" class="h-10 px-4 rounded-md border text-sm">Ləğv et</button><button type="submit" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm">Yarat</button></div>
        </form>
    </div>
</div>
<script>
function openClientModal() {
    document.getElementById('clientModalTitle').textContent = 'Yeni müştəri';
    document.getElementById('clientForm').action = '{{ route("clients.index") }}';
    document.getElementById('clientMethod').value = '';
    document.getElementById('cf_company').value = '{{ $companies->first()->id ?? "" }}';
    ['cf_name','cf_cname','cf_phone','cf_wa','cf_email','cf_ind','cf_addr','cf_notes'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('clientModal').classList.remove('hidden');
}
function editClient(c) {
    document.getElementById('clientModalTitle').textContent = 'Müştərini redaktə et';
    document.getElementById('clientForm').action = '{{ route("clients.index") }}/' + c.id;
    document.getElementById('clientMethod').value = 'PUT';
    document.getElementById('cf_company').value = c.company_id;
    document.getElementById('cf_name').value = c.client_name;
    document.getElementById('cf_cname').value = c.client_company_name || '';
    document.getElementById('cf_phone').value = c.phone || '';
    document.getElementById('cf_wa').value = c.whatsapp || '';
    document.getElementById('cf_email').value = c.email || '';
    document.getElementById('cf_ind').value = c.industry || '';
    document.getElementById('cf_addr').value = c.address || '';
    document.getElementById('cf_notes').value = c.notes || '';
    document.getElementById('clientModal').classList.remove('hidden');
}
function closeClientModal() { document.getElementById('clientModal').classList.add('hidden'); }
</script>
@endsection

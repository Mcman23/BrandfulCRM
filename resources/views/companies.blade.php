@extends('layouts.app')
@section('title', 'Şirkətlər')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div><h1 class="text-2xl font-bold">Şirkətlər</h1><p class="text-sm text-muted-foreground">Bütün biznesləri idarə edin</p></div>
        <button onclick="openModal()" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm font-medium hover:bg-primary/90">+ Yeni şirkət</button>
    </div>
    <div class="rounded-lg border bg-card shadow-sm">
        <table class="w-full text-sm">
            <thead><tr class="border-b">
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Şirkət adı</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Telefon</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Email</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Müştərilər</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Status</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Yaradılma</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Əməliyyatlar</th>
            </tr></thead>
            <tbody>
                @foreach ($companies as $c)
                <tr class="border-b hover:bg-muted/50">
                    <td class="p-4 font-medium">{{ $c->company_name }}</td>
                    <td class="p-4">{{ $c->phone ?: '—' }}</td>
                    <td class="p-4">{{ $c->email ?: '—' }}</td>
                    <td class="p-4">{{ $c->clients_count }}</td>
                    <td class="p-4"><span class="text-xs px-2 py-0.5 rounded-full {{ $c->status->value === 'ACTIVE' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">{{ $c->status->label() }}</span></td>
                    <td class="p-4 text-sm text-muted-foreground">{{ $c->created_at->format('d.m.Y') }}</td>
                    <td class="p-4">
                        <div class="flex gap-1">
                            <button onclick="editCompany('{{ $c->id }}', '{{ $c->company_name }}', '{{ $c->phone }}', '{{ $c->email }}', '{{ $c->address }}', '{{ $c->description }}')" class="p-2 hover:bg-accent rounded-md">✏️</button>
                            <form action="{{ route('companies') }}/{{ $c->id }}" method="POST" onsubmit="return confirm('Bu şirkəti silmək istədiyinizə əminsiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 hover:bg-accent rounded-md">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="companyModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeModal()"></div>
    <div class="relative z-50 w-full max-w-lg rounded-lg bg-card p-6 shadow-lg max-h-[90vh] overflow-y-auto m-4">
        <h2 id="modalTitle" class="text-xl font-bold mb-4">Yeni şirkət</h2>
        <form id="companyForm" method="POST" action="{{ route('companies') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="">
            <div><label class="text-sm font-medium">Şirkət adı</label><input name="company_name" id="f_name" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Telefon</label><input name="phone" id="f_phone" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Email</label><input name="email" type="email" id="f_email" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Ünvan</label><input name="address" id="f_address" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Təsvir</label><textarea name="description" id="f_desc" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1"></textarea></div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeModal()" class="h-10 px-4 rounded-md border text-sm">Ləğv et</button>
                <button type="submit" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm">Yarat</button>
            </div>
        </form>
    </div>
</div>
<script>
function openModal() {
    document.getElementById('modalTitle').textContent = 'Yeni şirkət';
    document.getElementById('companyForm').action = '{{ route("companies") }}';
    document.getElementById('formMethod').value = '';
    ['f_name','f_phone','f_email','f_address','f_desc'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('companyModal').classList.remove('hidden');
}
function editCompany(id, name, phone, email, address, desc) {
    document.getElementById('modalTitle').textContent = 'Şirkəti redaktə et';
    document.getElementById('companyForm').action = '{{ route("companies") }}/' + id;
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('f_name').value = name;
    document.getElementById('f_phone').value = phone;
    document.getElementById('f_email').value = email;
    document.getElementById('f_address').value = address;
    document.getElementById('f_desc').value = desc;
    document.getElementById('companyModal').classList.remove('hidden');
}
function closeModal() { document.getElementById('companyModal').classList.add('hidden'); }
</script>
@endsection

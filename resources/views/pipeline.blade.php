@extends('layouts.app')
@section('title', 'Pipeline')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div><h1 class="text-2xl font-bold">Pipeline</h1><p class="text-sm text-muted-foreground">Kanban lövhəsi — drag & drop</p></div>
        <button onclick="openLeadModal()" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm font-medium hover:bg-primary/90">+ Yeni lead</button>
    </div>
    <div class="overflow-x-auto pb-4">
        <div class="flex gap-4 min-w-max">
            @foreach ($columns as $col)
                @php $colLeads = $leads->where('status', $col['status']); @endphp
                <div class="kanban-column w-72 rounded-lg bg-muted/50 p-3" data-status="{{ $col['status']->value }}"
                    ondragover="event.preventDefault(); this.classList.add('drag-over')"
                    ondragleave="this.classList.remove('drag-over')"
                    ondrop="dropLead('{{ $col['status']->value }}', this)">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="h-3 w-3 rounded-full {{ $col['color'] }}"></div>
                        <h3 class="font-semibold text-sm">{{ $col['label'] }}</h3>
                        <span class="ml-auto text-xs text-muted-foreground bg-card px-2 py-0.5 rounded-full">{{ $colLeads->count() }}</span>
                    </div>
                    <div class="space-y-2">
                        @foreach ($colLeads as $lead)
                            <div class="kanban-card rounded-md bg-card p-3 shadow-sm border" draggable="true"
                                ondragstart="dragStart('{{ $lead->id }}', this)" ondragend="this.classList.remove('dragging')"
                                data-lead-id="{{ $lead->id }}">
                                <div class="flex items-start justify-between mb-2">
                                    <div><p class="font-medium text-sm">{{ $lead->client->client_name ?? '—' }}</p><p class="text-xs text-muted-foreground">{{ $lead->company->company_name ?? '' }}</p></div>
                                    <form action="{{ route('pipeline') }}/{{ $lead->id }}" method="POST" onsubmit="return confirm('Sil?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs opacity-50 hover:opacity-100">🗑️</button>
                                    </form>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs border px-2 py-0.5 rounded-full">{{ $lead->source }}</span>
                                    @if ($lead->budget)<span class="text-xs font-semibold">{{ number_format($lead->budget, 2) }} AZN</span>@endif
                                </div>
                                @if ($lead->service)<p class="text-xs text-muted-foreground mt-2">{{ $lead->service->name }}</p>@endif
                            </div>
                        @endforeach
                        @if ($colLeads->isEmpty())<p class="text-xs text-muted-foreground text-center py-4">Boş</p>@endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Lead Modal -->
<div id="leadModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closeLeadModal()"></div>
    <div class="relative z-50 w-full max-w-lg rounded-lg bg-card p-6 shadow-lg m-4">
        <h2 class="text-xl font-bold mb-4">Yeni lead</h2>
        <form method="POST" action="{{ route('pipeline') }}" class="space-y-4">
            @csrf
            <div><label class="text-sm font-medium">Şirkət</label>
                <select name="company_id" id="lf_company" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" onchange="loadClients()">
                    @foreach ($companies as $c)<option value="{{ $c->id }}">{{ $c->company_name }}</option>@endforeach
                </select>
            </div>
            <div><label class="text-sm font-medium">Müştəri</label>
                <select name="client_id" id="lf_client" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1">
                    <option value="">Seçin</option>
                    @foreach ($clients as $c)<option value="{{ $c->id }}" data-company="{{ $c->company_id }}">{{ $c->client_name }}</option>@endforeach
                </select>
            </div>
            <div><label class="text-sm font-medium">Mənbə</label><input name="source" placeholder="Instagram, Google, Tövsiyə..." required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Xidmət</label>
                <select name="service_id" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1">
                    <option value="">Seçin</option>
                    @foreach ($services as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach
                </select>
            </div>
            <div><label class="text-sm font-medium">Büdcə (AZN)</label><input name="budget" type="number" step="0.01" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div class="flex gap-2 justify-end"><button type="button" onclick="closeLeadModal()" class="h-10 px-4 rounded-md border text-sm">Ləğv et</button><button type="submit" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm">Yarat</button></div>
        </form>
    </div>
</div>
<script>
let draggedId = null;
function dragStart(id, el) { draggedId = id; el.classList.add('dragging'); }
function dropLead(status, el) {
    el.classList.remove('drag-over');
    if (draggedId) {
        fetch('{{ route("pipeline") }}/' + draggedId + '/status', {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ status: status })
        }).then(() => location.reload());
    }
}
function openLeadModal() { document.getElementById('leadModal').classList.remove('hidden'); }
function closeLeadModal() { document.getElementById('leadModal').classList.add('hidden'); }
function loadClients() {
    const companyId = document.getElementById('lf_company').value;
    document.querySelectorAll('#lf_client option').forEach(o => {
        o.style.display = (!o.value || o.dataset.company === companyId) ? '' : 'none';
    });
    document.getElementById('lf_client').value = '';
}
</script>
@endsection

@extends('layouts.app')
@section('title', $client->client_name)
@section('content')
<div class="space-y-6">
    <a href="{{ route('clients.index') }}" class="inline-flex items-center gap-1 text-sm hover:text-primary">← Geri</a>
    <div class="flex items-center gap-4">
        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary text-2xl font-bold">{{ strtoupper(substr($client->client_name, 0, 1)) }}</div>
        <div>
            <h1 class="text-2xl font-bold">{{ $client->client_name }}</h1>
            <p class="text-muted-foreground">{{ $client->client_company_name ?: '—' }}</p>
            <span class="text-xs border px-2 py-0.5 rounded-full mt-1 inline-block">{{ $client->company->company_name ?? '—' }}</span>
        </div>
    </div>
    <div class="grid gap-6 md:grid-cols-3">
        <div class="rounded-lg border bg-card shadow-sm md:col-span-1">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Əlaqə məlumatları</h3></div>
            <div class="p-6 pt-0 space-y-3">
                <div class="flex items-center gap-2 text-sm">📞 {{ $client->phone ?: '—' }}</div>
                <div class="flex items-center gap-2 text-sm">💬 {{ $client->whatsapp ?: '—' }}</div>
                <div class="flex items-center gap-2 text-sm">📧 {{ $client->email ?: '—' }}</div>
                <div class="flex items-center gap-2 text-sm">📍 {{ $client->address ?: '—' }}</div>
                <div class="flex items-center gap-2 text-sm">🏢 {{ $client->industry ?: '—' }}</div>
                @if ($client->notes)
                    <div class="pt-2 border-t"><p class="text-xs text-muted-foreground mb-1">Qeydlər</p><p class="text-sm">{{ $client->notes }}</p></div>
                @endif
            </div>
        </div>
        <div class="rounded-lg border bg-card shadow-sm md:col-span-2">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Əlaqə tarixçəsi</h3></div>
            <div class="p-6 pt-0">
                <div class="space-y-3">
                    @foreach ($client->activities as $a)
                        <div class="flex items-start gap-3 border-b pb-2">
                            <span class="text-xl">{{ $a->type->icon() }}</span>
                            <div class="flex-1"><p class="text-sm font-medium">{{ $a->description }}</p><p class="text-xs text-muted-foreground">{{ $a->user->name ?? '—' }} · {{ $a->date->format('d.m.Y H:i') }}</p></div>
                        </div>
                    @endforeach
                    @if ($client->activities->isEmpty())<p class="text-sm text-muted-foreground">Əlaqə qeydi yoxdur</p>@endif
                </div>
            </div>
        </div>
    </div>
    <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded-lg border bg-card shadow-sm">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Satışlar</h3></div>
            <div class="p-6 pt-0">
                @foreach ($client->deals as $d)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div><p class="text-sm font-medium">{{ $d->service->name ?? 'Xidmət' }}</p><p class="text-xs text-muted-foreground">{{ number_format($d->amount, 2) }} AZN</p></div>
                        <span class="text-xs px-2 py-0.5 rounded-full @if($d->status->value==='QAZANILDI')bg-green-500 text-white@elseif($d->status->value==='ITIRILDI')bg-red-500 text-white@else bg-gray-200 @endif">{{ $d->status->label() }}</span>
                    </div>
                @endforeach
                @if ($client->deals->isEmpty())<p class="text-sm text-muted-foreground">Satış yoxdur</p>@endif
            </div>
        </div>
        <div class="rounded-lg border bg-card shadow-sm">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Ödənişlər</h3></div>
            <div class="p-6 pt-0">
                @foreach ($client->payments as $p)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div><p class="text-sm font-medium">{{ number_format($p->amount, 2) }} AZN</p><p class="text-xs text-muted-foreground">{{ $p->payment_date ? $p->payment_date->format('d.m.Y H:i') : '—' }}</p></div>
                        <span class="text-xs px-2 py-0.5 rounded-full @if($p->status->value==='ODENILDI')bg-green-500 text-white@else bg-yellow-500 text-white @endif">{{ $p->status->label() }}</span>
                    </div>
                @endforeach
                @if ($client->payments->isEmpty())<p class="text-sm text-muted-foreground">Ödəniş yoxdur</p>@endif
            </div>
        </div>
    </div>
    <div class="rounded-lg border bg-card shadow-sm">
        <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Leads</h3></div>
        <div class="p-6 pt-0">
            @foreach ($client->leads as $l)
                <div class="flex items-center justify-between border-b pb-2">
                    <div><p class="text-sm font-medium">{{ $l->service->name ?? '—' }}</p><p class="text-xs text-muted-foreground">Mənbə: {{ $l->source }} · {{ $l->budget ? number_format($l->budget, 2).' AZN' : '—' }}</p></div>
                    <span class="text-xs border px-2 py-0.5 rounded-full">{{ $l->status->label() }}</span>
                </div>
            @endforeach
            @if ($client->leads->isEmpty())<p class="text-sm text-muted-foreground">Lead yoxdur</p>@endif
        </div>
    </div>
</div>
@endsection

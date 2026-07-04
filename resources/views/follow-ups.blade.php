@extends('layouts.app')
@section('title', 'Geri Dönüşlər')
@section('content')
<div class="space-y-6">
    <div><h1 class="text-2xl font-bold">Geri dönüşlər</h1><p class="text-sm text-muted-foreground">Planlaşdırılmış əlaqələr</p></div>
    @if ($overdue->isNotEmpty())
    <div class="rounded-lg border border-red-500/50 bg-card shadow-sm">
        <div class="p-6 pb-0"><div class="flex items-center gap-2"><span class="text-xl">⚠️</span><h3 class="text-lg font-semibold text-red-500">Keçmiş ({{ $overdue->count() }})</h3></div></div>
        <div class="p-6 pt-0">
            @foreach ($overdue as $f)
            <div class="flex items-center justify-between border-b pb-2">
                <div><p class="font-medium text-sm">{{ $f->title }}</p><p class="text-xs text-muted-foreground">{{ $f->client->client_name ?? '—' }} · {{ $f->reminder_date->format('d.m.Y') }}</p></div>
                <span class="text-xs px-2 py-0.5 rounded-full bg-red-500 text-white">Keçmiş</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <div class="rounded-lg border bg-card shadow-sm">
        <div class="p-6 pb-0"><div class="flex items-center gap-2"><span class="text-xl">📅</span><h3 class="text-lg font-semibold">Gözləyən ({{ $upcoming->count() }})</h3></div></div>
        <div class="p-6 pt-0">
            @foreach ($upcoming as $f)
            <div class="flex items-center justify-between border-b pb-2">
                <div><p class="font-medium text-sm">{{ $f->title }}</p><p class="text-xs text-muted-foreground">{{ $f->client->client_name ?? '—' }} · {{ $f->reminder_date->format('d.m.Y') }}</p></div>
                <span class="text-xs px-2 py-0.5 rounded-full bg-yellow-500 text-white">Gözləyən</span>
            </div>
            @endforeach
            @if ($upcoming->isEmpty())<p class="text-sm text-muted-foreground">Geri dönüş yoxdur</p>@endif
        </div>
    </div>
</div>
@endsection

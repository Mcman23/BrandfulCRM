@extends('layouts.app')
@section('title', 'İdarəetmə Paneli')
@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold">İdarəetmə paneli</h1>
        <p class="text-sm text-muted-foreground">{{ session('selected_company_id') ? 'Seçilmiş şirkət' : 'Bütün şirkətlər' }} üzrə statistika</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-5">
        @php
            $stats = [
                ['label' => 'Ümumi müştəri', 'value' => $totalClients, 'icon' => '👥', 'bg' => 'bg-blue-500/10'],
                ['label' => 'Yeni müraciət', 'value' => $newLeads->count(), 'icon' => '🆕', 'bg' => 'bg-purple-500/10'],
                ['label' => 'Aktiv satış', 'value' => $activeDeals, 'icon' => '📈', 'bg' => 'bg-orange-500/10'],
                ['label' => 'Gəlir', 'value' => number_format($wonAmount, 2) . ' AZN', 'icon' => '💰', 'bg' => 'bg-green-500/10'],
                ['label' => 'Geri dönüş', 'value' => $pendingFollowUps->count(), 'icon' => '📅', 'bg' => 'bg-red-500/10'],
            ];
        @endphp
        @foreach ($stats as $s)
            <div class="rounded-lg border bg-card shadow-sm p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-muted-foreground">{{ $s['label'] }}</p>
                        <p class="text-2xl font-bold mt-1">{{ $s['value'] }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg {{ $s['bg'] }} text-2xl">{{ $s['icon'] }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded-lg border bg-card shadow-sm">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Son müraciətlər</h3></div>
            <div class="p-6 pt-0">
                <div class="space-y-3">
                    @foreach ($newLeads as $lead)
                        <div class="flex items-center justify-between border-b pb-2">
                            <div>
                                <p class="font-medium text-sm">{{ $lead->client->client_name ?? '—' }}</p>
                                <p class="text-xs text-muted-foreground">{{ $lead->source }} · {{ $lead->created_at->format('d.m.Y') }}</p>
                            </div>
                            <span class="text-xs bg-secondary px-2 py-0.5 rounded-full">{{ $lead->company->company_name ?? '' }}</span>
                        </div>
                    @endforeach
                    @if ($newLeads->isEmpty())
                        <p class="text-sm text-muted-foreground">Yeni müraciət yoxdur</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="rounded-lg border bg-card shadow-sm">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Geri dönüşlər</h3></div>
            <div class="p-6 pt-0">
                <div class="space-y-3">
                    @foreach ($pendingFollowUps as $fu)
                        <div class="flex items-center justify-between border-b pb-2">
                            <div>
                                <p class="font-medium text-sm">{{ $fu->title }}</p>
                                <p class="text-xs text-muted-foreground">{{ $fu->client->client_name ?? '—' }} · {{ $fu->reminder_date->format('d.m.Y') }}</p>
                            </div>
                            @php $isOverdue = $fu->reminder_date < now(); @endphp
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $isOverdue ? 'bg-red-500 text-white' : 'bg-yellow-500 text-white' }}">{{ $isOverdue ? 'Keçmiş' : 'Gözləyən' }}</span>
                        </div>
                    @endforeach
                    @if ($pendingFollowUps->isEmpty())
                        <p class="text-sm text-muted-foreground">Geri dönüş yoxdur</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-lg border bg-card shadow-sm">
        <div class="p-6 pb-0 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Ödəniş xülasəsi</h3>
            <span class="text-xs bg-green-500 text-white px-2 py-0.5 rounded-full">{{ number_format($paidAmount, 2) }} AZN</span>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-3 gap-4 text-center">
                <div><p class="text-sm text-muted-foreground">Ümumi</p><p class="text-xl font-bold">{{ $payments->count() }}</p></div>
                <div><p class="text-sm text-muted-foreground">Ödənilmiş</p><p class="text-xl font-bold text-green-500">{{ $paidCount }}</p></div>
                <div><p class="text-sm text-muted-foreground">Məbləğ</p><p class="text-xl font-bold">{{ number_format($payments->sum('amount'), 2) }} AZN</p></div>
            </div>
        </div>
    </div>
</div>
@endsection

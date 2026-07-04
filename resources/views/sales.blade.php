@extends('layouts.app')
@section('title', 'Satış Paneli')
@section('content')
<div class="space-y-6">
    <div><h1 class="text-2xl font-bold">Satış paneli</h1><p class="text-sm text-muted-foreground">Satış və ödəniş statistikaları</p></div>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        @php $stats = [
            ['label' => 'Ümumi satış', 'value' => number_format($totalAmount, 2).' AZN', 'icon' => '💰', 'bg' => 'bg-blue-500/10'],
            ['label' => 'Qazanılan', 'value' => number_format($wonAmount, 2).' AZN', 'icon' => '📈', 'bg' => 'bg-green-500/10'],
            ['label' => 'Qazanılan say', 'value' => $wonDeals->count(), 'icon' => '🎯', 'bg' => 'bg-purple-500/10'],
            ['label' => 'Konversiya', 'value' => '%'.number_format($conversionRate, 1), 'icon' => '📊', 'bg' => 'bg-orange-500/10'],
        ]; @endphp
        @foreach ($stats as $s)
            <div class="rounded-lg border bg-card shadow-sm p-5">
                <div class="flex items-center justify-between">
                    <div><p class="text-sm text-muted-foreground">{{ $s['label'] }}</p><p class="text-2xl font-bold mt-1">{{ $s['value'] }}</p></div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg {{ $s['bg'] }} text-2xl">{{ $s['icon'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded-lg border bg-card shadow-sm">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Satışlar</h3></div>
            <table class="w-full text-sm">
                <thead><tr class="border-b"><th class="h-12 px-4 text-left font-medium text-muted-foreground">Müştəri</th><th class="h-12 px-4 text-left font-medium text-muted-foreground">Məbləğ</th><th class="h-12 px-4 text-left font-medium text-muted-foreground">Status</th><th class="h-12 px-4 text-left font-medium text-muted-foreground">Tarix</th></tr></thead>
                <tbody>
                    @foreach ($deals as $d)
                    <tr class="border-b"><td class="p-4 text-sm">{{ $d->client->client_name ?? '—' }}</td><td class="p-4 font-semibold">{{ number_format($d->amount, 2) }} AZN</td><td class="p-4"><span class="text-xs px-2 py-0.5 rounded-full @if($d->status->value==='QAZANILDI')bg-green-500 text-white@elseif($d->status->value==='ITIRILDI')bg-red-500 text-white@else bg-gray-200 @endif">{{ $d->status->label() }}</span></td><td class="p-4 text-sm text-muted-foreground">{{ $d->close_date ? $d->close_date->format('d.m.Y') : '—' }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="rounded-lg border bg-card shadow-sm">
            <div class="p-6 pb-0"><h3 class="text-lg font-semibold">Ödənişlər</h3></div>
            <table class="w-full text-sm">
                <thead><tr class="border-b"><th class="h-12 px-4 text-left font-medium text-muted-foreground">Müştəri</th><th class="h-12 px-4 text-left font-medium text-muted-foreground">Məbləğ</th><th class="h-12 px-4 text-left font-medium text-muted-foreground">Status</th><th class="h-12 px-4 text-left font-medium text-muted-foreground">Tarix</th></tr></thead>
                <tbody>
                    @foreach ($payments as $p)
                    <tr class="border-b"><td class="p-4 text-sm">{{ $p->client->client_name ?? '—' }}</td><td class="p-4 font-semibold">{{ number_format($p->amount, 2) }} AZN</td><td class="p-4"><span class="text-xs px-2 py-0.5 rounded-full @if($p->status->value==='ODENILDI')bg-green-500 text-white@else bg-yellow-500 text-white @endif">{{ $p->status->label() }}</span></td><td class="p-4 text-sm text-muted-foreground">{{ $p->payment_date ? $p->payment_date->format('d.m.Y') : '—' }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

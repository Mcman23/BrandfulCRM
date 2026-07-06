@extends('layouts.app')
@section('title', 'İstifadəçilər')
@section('content')
<div class="space-y-6">
    <div><h1 class="text-2xl font-bold">İstifadəçilər</h1><p class="text-sm text-muted-foreground">Sistem istifadəçiləri</p></div>
    <div class="rounded-lg border bg-card shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="border-b">
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Ad</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Email</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Rol</th>
                <th class="h-12 px-4 text-left font-medium text-muted-foreground">Qeydiyyat</th>
            </tr></thead>
            <tbody>
                @foreach ($users as $u)
                <tr class="border-b hover:bg-muted/50">
                    <td class="p-4 font-medium">{{ $u->name }}</td>
                    <td class="p-4">{{ $u->email }}</td>
                    <td class="p-4"><span class="text-xs px-2 py-0.5 rounded-full @if($u->role->value==='SUPER_ADMIN')bg-primary text-primary-foreground@elseif($u->role->value==='MENEGER')bg-secondary@else border @endif">{{ $u->role->label() }}</span></td>
                    <td class="p-4 text-sm text-muted-foreground">{{ $u->created_at->format('d.m.Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Tənzimləmələr')
@section('content')
<div class="space-y-6 max-w-2xl">
    <div><h1 class="text-2xl font-bold">Tənzimləmələr</h1><p class="text-sm text-muted-foreground">Hesab və sistem tənzimləmələri</p></div>
    <div class="rounded-lg border bg-card shadow-sm">
        <div class="p-6 pb-0"><h3 class="font-semibold">Profil məlumatları</h3><p class="text-sm text-muted-foreground mt-1">Şəxsi məlumatlarınızı yeniləyin</p></div>
        <form action="{{ route('settings.profile') }}" method="POST" class="p-6 pt-4 space-y-4">
            @csrf @method('PUT')
            <div><label class="text-sm font-medium">Ad</label><input name="name" value="{{ auth()->user()->name }}" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Email</label><input value="{{ auth()->user()->email }}" disabled class="flex h-10 w-full rounded-md border border-input bg-muted px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Rol</label><input value="{{ auth()->user()->role->label() }}" disabled class="flex h-10 w-full rounded-md border border-input bg-muted px-3 py-2 text-sm mt-1" /></div>
            <button type="submit" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm">Yenilə</button>
        </form>
    </div>
    <div class="rounded-lg border bg-card shadow-sm">
        <div class="p-6 pb-0"><h3 class="font-semibold">Təhlükəsizlik</h3><p class="text-sm text-muted-foreground mt-1">Şifrə dəyişikliyi</p></div>
        <form action="{{ route('settings.password') }}" method="POST" class="p-6 pt-4 space-y-4">
            @csrf @method('PUT')
            <div><label class="text-sm font-medium">Cari şifrə</label><input name="current_password" type="password" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Yeni şifrə</label><input name="password" type="password" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <div><label class="text-sm font-medium">Yeni şifrə (təkrar)</label><input name="password_confirmation" type="password" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm mt-1" /></div>
            <button type="submit" class="h-10 px-4 rounded-md bg-primary text-primary-foreground text-sm">Şifrəni dəyiş</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.auth')
@section('content')
<div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-violet-100 p-4">
    <div class="w-full max-w-md rounded-2xl border bg-card shadow-[0_8px_30px_rgb(0,0,0,0.08)] p-8">
        <div class="text-center mb-7">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl brand-logo text-white font-bold text-2xl shadow-lg shadow-indigo-500/30">B</div>
            <h1 class="text-2xl font-extrabold tracking-tight">BizCRM</h1>
            <p class="text-sm text-muted-foreground mt-1">İdarəetmə panelinə daxil olun</p>
        </div>
        @if($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-3 text-sm text-red-600 flex items-center gap-2">
                <span>⚠️</span>{{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label for="email" class="text-sm font-medium">Email</label>
                <input id="email" type="email" name="email" placeholder="email@nümunə.az" required
                    value="{{ old('email') }}"
                    class="flex h-11 w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus:outline-none transition-shadow" />
            </div>
            <div class="space-y-2">
                <label for="password" class="text-sm font-medium">Şifrə</label>
                <input id="password" type="password" name="password" placeholder="••••••••" required
                    class="flex h-11 w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus:outline-none transition-shadow" />
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" value="1" class="rounded" checked /> Məni xatırla
            </label>
            <button type="submit" class="w-full h-11 rounded-lg brand-logo text-white text-sm font-semibold hover:opacity-90 transition-opacity shadow-lg shadow-indigo-500/25">
                Daxil ol
            </button>
            <div class="rounded-lg bg-muted p-3 text-xs text-muted-foreground">
                <p class="font-semibold mb-1 text-foreground">Demo giriş:</p>
                <p>Admin: admin@bizcrm.az / admin123</p>
                <p>Menecer: aysel@brandful.az / menecer123</p>
            </div>
        </form>
    </div>
</div>
@endsection

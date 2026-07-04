@extends('layouts.auth')
@section('content')
<div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-blue-50 via-white to-purple-50 p-4">
    <div class="w-full max-w-md rounded-lg border bg-white shadow-sm p-6">
        <div class="text-center mb-6">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white font-bold text-xl">B</div>
            <h1 class="text-2xl font-bold">BizCRM</h1>
            <p class="text-sm text-gray-500 mt-1">İdarəetmə panelinə daxil olun</p>
        </div>
        @if($errors->any())
            <div class="mb-4 rounded-md bg-red-50 border border-red-200 p-3 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label for="email" class="text-sm font-medium">Email</label>
                <input id="email" type="email" name="email" placeholder="email@nümunə.az" required
                    value="{{ old('email') }}"
                    class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="space-y-2">
                <label for="password" class="text-sm font-medium">Şifrə</label>
                <input id="password" type="password" name="password" placeholder="••••••••" required
                    class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="rounded" checked /> Məni xatırla
            </label>
            <button type="submit" class="w-full h-10 rounded-md bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition-colors">
                Daxil ol
            </button>
            <div class="rounded-md bg-gray-50 p-3 text-xs text-gray-500">
                <p class="font-semibold mb-1">Demo giriş:</p>
                <p>Admin: admin@bizcrm.az / admin123</p>
                <p>Menecer: aysel@brandful.az / menecer123</p>
            </div>
        </form>
    </div>
</div>
@endsection

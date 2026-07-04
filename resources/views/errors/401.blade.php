@extends('layouts.auth')
@section('content')
<div class="flex min-h-screen items-center justify-center p-4">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-gray-300">401</h1>
        <p class="text-lg text-gray-500 mt-2">Səlahiyyət tələb olunur</p>
        <a href="/login" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md">Giriş</a>
    </div>
</div>
@endsection

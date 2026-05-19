@extends('layouts.app')

@section('content')
<div class="text-center py-20">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
        Selamat Datang di SIBAST
    </h1>
    <p class="text-xl text-gray-600 mb-8">
        Sistem otentikasi sederhana tanpa package tambahan.
    </p>
    
    @guest
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700">Login</a>
            <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 py-2 px-6 rounded-md border border-indigo-600 hover:bg-indigo-50">Register</a>
        </div>
    @else
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="inline-block bg-white text-indigo-600 py-2 px-6 rounded-md border border-indigo-600 hover:bg-indigo-50">Edit Profil</a>
        </div>
    @endguest
</div>
@endsection

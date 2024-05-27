@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Dashboard</h2>
        <p class="text-gray-600 text-lg">Welcome, <span class="font-semibold">{{ Auth::user()->user_name }}</span>!</p>
        <p class="text-gray-600 mt-1">You are logged in.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="mt-8 w-full bg-red-500 text-white py-3 px-4 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-500 focus:ring-opacity-50 transition-colors duration-300">Logout</button>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="user_name" class="block text-gray-700">Username</label>
                <input type="text" name="user_name" id="user_name"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required
                    autofocus value="{{ old('user_name') }}">
                @error('user_name')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required
                    value="{{ old('password') }}">
                @error('password')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <input type="checkbox" name="is_ldap" id="is_ldap" class="mr-2" value="1" {{ old('is_featured') ? 'checked="checked"' : '' }}>
                <label for="is_ldap" class="text-gray-700">is_ldap</label>
                @error('is_ldap')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
            </div>
        </form>
    </div>
@endsection

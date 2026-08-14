<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    
<div class="min-h-screen flex items-center justify-center bg-[#162456] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 border border-gray-100">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Selamat Datang</h1>
            <p class="text-gray-500 mt-2 text-sm">Silakan login ke akun Anda</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700" 
                    required
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    {{-- <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">Ingat saya</label> --}}
                </div>
                <div class="text-sm">
                    <a href="#" class="font-medium text-[#162456] hover:text-blue-800 transition-colors">Lupa password?</a>
                </div>
            </div>

            <button 
                type="submit" 
                class="w-full bg-[#162456] hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-200"
            >
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium text-[#162456] hover:text-blue-800 transition-colors">Daftar sekarang</a>
        </p>

    </div>
</div>

</body>
</html>
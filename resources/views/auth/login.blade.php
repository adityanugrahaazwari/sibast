<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIBAST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div class="flex w-full max-w-4xl bg-white rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100">
        <!-- Left Side: Decorative -->
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-600 p-12 flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-64 h-64 bg-indigo-500 rounded-full opacity-20"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-indigo-400 rounded-full opacity-20"></div>
            
            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-12">
                    <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md border border-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight">SIBAST</span>
                </div>
                
                <h1 class="text-4xl font-bold leading-tight mb-4">Sistem Berita Acara <br>Serah Terima</h1>
                <p class="text-indigo-100 text-lg">Kelola dokumentasi serah terima barang Anda dengan mudah, aman, dan terorganisir.</p>
            </div>
            
            <div class="relative z-10">
                <div class="flex -space-x-2 mb-4">
                    <div class="w-8 h-8 rounded-full bg-indigo-400 border-2 border-indigo-600 flex items-center justify-center text-[10px] font-bold text-white">AD</div>
                    <div class="w-8 h-8 rounded-full bg-indigo-300 border-2 border-indigo-600 flex items-center justify-center text-[10px] font-bold text-white">US</div>
                </div>
                <p class="text-sm text-indigo-200">Bergabunglah dengan ribuan pengguna lainnya.</p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 p-8 sm:p-12 md:p-16">
            <div class="max-w-sm mx-auto">
                <div class="lg:hidden flex items-center space-x-2 mb-8">
                    <div class="bg-indigo-600 p-1.5 rounded-lg text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">SIBAST</span>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h2>
                <p class="text-gray-500 mb-10">Silakan login untuk mengakses akun Anda.</p>

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                        </div>
                        <input type="password" name="password" id="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none">
                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600 font-medium cursor-pointer">Ingat saya di perangkat ini</label>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center justify-center group">
                        <span>Masuk ke Akun</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                </form>

                <div class="mt-12 pt-8 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-500 italic">"Efisiensi dalam setiap serah terima."</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

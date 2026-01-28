<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Ticketing App') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

    {{-- NAVBAR --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/bengkelkoding.webp') }}" class="h-10 object-contain" alt="Logo">
                <span class="font-bold text-lg">
                    Ticketing App
                </span>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('login') }}"
                    class="px-5 py-2 rounded-lg border border-slate-300
                          hover:bg-slate-100 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-5 py-2 rounded-lg bg-primary text-black
                          hover:opacity-90 transition">
                    Daftar
                </a>
            </div>
        </div>
    </header>

    {{-- HERO --}}
    <section class="bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Platform Pemesanan Tiket Event
                    <span class="block text-cyan-200">
                        Cepat & Terpercaya
                    </span>
                </h1>

                <p class="mt-5 text-white/80 max-w-xl">
                    Pesan tiket konser, seminar, dan berbagai event dengan sistem yang
                    aman, mudah, dan real-time.
                </p>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 rounded-xl bg-white text-indigo-700
                              font-semibold hover:bg-slate-100 transition">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-6 py-3 rounded-xl border border-white/40
                              hover:bg-white/10 transition">
                        Buat Akun
                    </a>
                </div>
            </div>


        </div>
    </section>

    {{-- FEATURES --}}
    <section class="max-w-7xl mx-auto px-6 py-20">
        <h2 class="text-3xl font-bold text-center mb-14">
            Kenapa Menggunakan Sistem Kami?
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <div class="bg-white rounded-2xl p-8 shadow border">
                <div class="text-3xl mb-4">⚡</div>
                <h3 class="font-bold text-lg mb-2">
                    Proses Cepat
                </h3>
                <p class="text-slate-600">
                    Pemesanan tiket dilakukan dalam hitungan detik tanpa ribet.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow border">
                <div class="text-3xl mb-4">🔒</div>
                <h3 class="font-bold text-lg mb-2">
                    Aman & Terpercaya
                </h3>
                <p class="text-slate-600">
                    Data transaksi dan pengguna terlindungi dengan baik.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow border">
                <div class="text-3xl mb-4">🎫</div>
                <h3 class="font-bold text-lg mb-2">
                    Banyak Event
                </h3>
                <p class="text-slate-600">
                    Kelola dan temukan berbagai event menarik dalam satu platform.
                </p>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-20 text-center">
            <h2 class="text-3xl font-bold mb-4">
                Siap Mengikuti Event Favoritmu?
            </h2>
            <p class="text-white/70 mb-8">
                Daftar sekarang dan pesan tiket dengan mudah
            </p>

            <a href="{{ route('register') }}" class="inline-block px-8 py-4 rounded-xl bg-primary text-black
                      font-semibold hover:opacity-90

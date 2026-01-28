<x-layouts.admin title="Dashboard Admin">

    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-base-content">
                Dashboard Admin
            </h1>
            <p class="text-base-content/60 mt-1">
                Ringkasan data sistem ticketing
            </p>
        </div>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- TOTAL EVENT --}}
            <div
                class="rounded-2xl bg-base-100 border border-base-300 p-6
                        shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-base-content/60">
                            Total Event
                        </p>
                        <h2 class="text-4xl font-bold mt-2">
                            {{ $totalEvents ?? 0 }}
                        </h2>
                    </div>

                    <div class="p-3 rounded-xl bg-primary/10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2v-6H3v6a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- TOTAL KATEGORI --}}
            <div
                class="rounded-2xl bg-base-100 border border-base-300 p-6
                        shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-base-content/60">
                            Kategori
                        </p>
                        <h2 class="text-4xl font-bold mt-2">
                            {{ $totalCategories ?? 0 }}
                        </h2>
                    </div>

                    <div class="p-3 rounded-xl bg-secondary/10 text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- TOTAL TRANSAKSI --}}
            <div
                class="rounded-2xl bg-base-100 border border-base-300 p-6
                        shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-base-content/60">
                            Total Transaksi
                        </p>
                        <h2 class="text-4xl font-bold mt-2">
                            {{ $totalOrders ?? 0 }}
                        </h2>
                    </div>

                    <div class="p-3 rounded-xl bg-accent/10 text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                                     3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- OPTIONAL: INFO / WELCOME --}}
        <div class="mt-10 rounded-2xl bg-base-100 border border-base-300 p-6">
            <h3 class="text-lg font-semibold mb-2">
                Selamat datang di Dashboard Admin
            </h3>
            <p class="text-base-content/60">
                Gunakan menu di sebelah kiri untuk mengelola event, kategori,
                serta memantau transaksi tiket.
            </p>
        </div>

    </div>

</x-layouts.admin>

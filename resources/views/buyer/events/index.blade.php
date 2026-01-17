<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">

        <div class="max-w-7xl mx-auto px-4 py-12">

            {{-- HERO HEADER --}}
            <div
                class="relative overflow-hidden rounded-3xl
                    bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600
                    p-10 mb-12 text-white shadow-xl">

                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold tracking-tight">
                        Jelajahi Event Terbaik
                    </h1>
                    <p class="mt-2 text-white/80 max-w-xl">
                        Temukan konser, seminar, dan pengalaman terbaik dengan tiket resmi & terpercaya
                    </p>

                    <a href="{{ route('buyer.orders.history') }}"
                        class="inline-flex mt-6 items-center
                          px-6 py-3 rounded-xl
                          bg-white text-violet-700 font-semibold
                          hover:bg-slate-100 transition shadow">
                        Riwayat Pembelian
                    </a>
                </div>

                {{-- decorative blur --}}
                <div
                    class="absolute -top-24 -right-24 w-96 h-96
                        bg-cyan-400/30 rounded-full blur-3xl">
                </div>
            </div>

            {{-- FILTER --}}
            <form method="GET" action="{{ route('buyer.events.index') }}"
                class="bg-white/80 backdrop-blur
                     border border-slate-200
                     rounded-2xl p-6 mb-12
                     flex flex-col md:flex-row gap-4
                     shadow-lg">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari event, lokasi, atau kata kunci..."
                    class="flex-1 rounded-xl border-slate-300
                       focus:ring-violet-500 focus:border-violet-500">

                <select name="kategori"
                    class="w-full md:w-60 rounded-xl border-slate-300
                           focus:ring-violet-500 focus:border-violet-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('kategori') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-8 py-3 rounded-xl
                       bg-gradient-to-r from-violet-600 to-indigo-600
                       text-white font-semibold
                       hover:opacity-90 transition shadow">
                    Cari
                </button>
            </form>

            {{-- EVENT GRID --}}
            @if ($events->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                    @foreach ($events as $event)
                        {{-- CARD --}}
                        <div
                            class="rounded-3xl
                                bg-white border border-slate-200
                                shadow-md hover:shadow-2xl
                                transition-all duration-300
                                hover:-translate-y-1
                                flex flex-col h-full">

                            {{-- IMAGE --}}
                            <div class="relative h-56 overflow-hidden rounded-t-3xl">
                                <img src="{{ asset('images/events/' . $event->gambar) }}" alt="{{ $event->judul }}"
                                    class="w-full h-full object-cover
                                       transition duration-500 hover:scale-110">

                                <span
                                    class="absolute top-4 left-4
                                         bg-cyan-500 text-white text-xs
                                         px-4 py-1.5 rounded-full shadow-lg">
                                    {{ $event->kategori->nama }}
                                </span>
                            </div>

                            {{-- CONTENT --}}
                            <div class="p-6 flex flex-col flex-1">
                                <h2 class="text-xl font-bold text-slate-900 mb-2">
                                    {{ $event->judul }}
                                </h2>

                                <div class="text-sm text-slate-500 space-y-1 mb-6">
                                    <p>{{ $event->lokasi }}</p>
                                    <p>{{ $event->tanggal_waktu->format('d M Y • H:i') }}</p>
                                </div>

                                {{-- BUTTON DETAIL (FIX FINAL) --}}
                                <a href="{{ route('buyer.events.show', $event->id) }}"
                                    class="mt-auto inline-flex justify-center
                                      px-5 py-3 rounded-xl
                                     bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 text-white">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- PAGINATION --}}
                <div class="mt-14">
                    {{ $events->withQueryString()->links() }}
                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="text-center py-24">
                    <h3 class="text-2xl font-bold text-slate-700">
                        Event tidak ditemukan
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Coba kata kunci lain atau pilih kategori berbeda
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

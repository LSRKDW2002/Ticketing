<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">

        <div class="max-w-6xl mx-auto px-4 py-12">

            {{-- HEADER --}}
            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">
                    Riwayat Pembelian
                </h1>
                <p class="text-slate-500 mt-1">
                    Daftar transaksi tiket yang pernah kamu lakukan
                </p>
            </div>

            {{-- SUCCESS ALERT --}}
            @if (session('success'))
                <div
                    class="mb-8 p-4 rounded-xl
                        bg-emerald-100 text-emerald-800
                        border border-emerald-200">
                    {{ session('success') }}
                </div>
            @endif

            @if ($orders->count())

                {{-- TABLE DESKTOP --}}
                <div
                    class="hidden md:block
                        bg-white rounded-3xl
                        border border-slate-200
                        shadow-lg overflow-hidden">

                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-100 text-slate-700">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                                <th class="px-6 py-4 text-left font-semibold">Event</th>
                                <th class="px-6 py-4 text-right font-semibold">Total</th>
                                <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr
                                    class="border-t border-slate-200
                                       hover:bg-slate-50 transition">

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $order->order_date->format('d M Y • H:i') }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-slate-900">
                                        {{ $order->event->judul }}
                                    </td>

                                    <td class="px-6 py-4 text-right font-bold text-violet-600">
                                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('buyer.orders.show', $order->id) }}"
                                            class="inline-flex px-4 py-2 rounded-xl
                                              bg-gradient-to-r from-violet-600 to-indigo-600
                                              text-white text-sm font-semibold
                                              hover:opacity-90 transition shadow">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- MOBILE CARD --}}
                <div class="md:hidden space-y-6">
                    @foreach ($orders as $order)
                        <div
                            class="bg-white rounded-3xl
                                border border-slate-200
                                shadow-lg p-6">

                            <p class="text-sm text-slate-500 mb-1">
                                {{ $order->order_date->format('d M Y • H:i') }}
                            </p>

                            <h3 class="text-lg font-bold text-slate-900 mb-3">
                                {{ $order->event->judul }}
                            </h3>

                            <div class="flex items-center justify-between">
                                <span class="font-bold text-violet-600">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </span>

                                <a href="{{ route('buyer.orders.show', $order->id) }}"
                                    class="px-5 py-2.5 rounded-xl
                                      bg-slate-900 text-white
                                      text-sm font-semibold
                                      hover:bg-slate-800 transition">
                                    Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="text-center py-24">
                    <h3 class="text-2xl font-bold text-slate-700">
                        Belum ada pembelian
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Kamu belum membeli tiket event apa pun
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

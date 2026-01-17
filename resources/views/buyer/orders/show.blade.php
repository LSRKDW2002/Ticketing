<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">

        <div class="max-w-4xl mx-auto px-4 py-12">

            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-10 gap-4">
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">
                        Detail Pembelian
                    </h1>
                    <p class="text-slate-500 mt-1">
                        Ringkasan transaksi & tiket yang kamu beli
                    </p>
                </div>

                {{-- STATUS --}}
                <span
                    class="inline-flex items-center
                         px-5 py-2 rounded-full text-sm font-semibold
                         bg-emerald-100 text-emerald-700
                         border border-emerald-200">
                    Berhasil
                </span>
            </div>

            {{-- EVENT INFO --}}
            <div
                class="bg-white rounded-3xl
                    border border-slate-200
                    shadow-lg p-8 mb-10">

                <h2 class="text-2xl font-bold text-slate-900 mb-4">
                    {{ $order->event->judul }}
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4
                        text-sm text-slate-600">
                    <div>{{ $order->event->lokasi }}</div>
                    <div>{{ $order->event->tanggal_waktu->format('d M Y • H:i') }}</div>
                    <div>Dibeli {{ $order->order_date->format('d M Y • H:i') }}</div>
                </div>
            </div>

            {{-- TICKET LIST --}}
            <div
                class="bg-white rounded-3xl
                    border border-slate-200
                    shadow-lg overflow-hidden">

                <div class="p-6 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-900">
                        Tiket yang Dibeli
                    </h3>
                </div>

                {{-- DESKTOP TABLE --}}
                <div class="hidden md:block">
                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-100 text-slate-700">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Tipe Tiket</th>
                                <th class="px-6 py-4 text-right font-semibold">Harga</th>
                                <th class="px-6 py-4 text-center font-semibold">Jumlah</th>
                                <th class="px-6 py-4 text-right font-semibold">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->detailOrders as $detail)
                                <tr class="border-t border-slate-200 hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $detail->tiket->tipe }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        Rp {{ number_format($detail->tiket->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $detail->jumlah }}
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-violet-600">
                                        Rp {{ number_format($detail->subtotal_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- MOBILE --}}
                <div class="md:hidden divide-y divide-slate-200">
                    @foreach ($order->detailOrders as $detail)
                        <div class="p-6">
                            <h4 class="font-bold text-slate-900">
                                {{ $detail->tiket->tipe }}
                            </h4>
                            <p class="text-sm text-slate-500 mt-1">
                                Harga: Rp {{ number_format($detail->tiket->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-slate-500">
                                Jumlah: {{ $detail->jumlah }}
                            </p>
                            <p class="mt-3 font-bold text-violet-600">
                                Subtotal: Rp {{ number_format($detail->subtotal_harga, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- TOTAL --}}
                <div class="p-8 border-t border-slate-200
                        flex justify-end bg-slate-50">
                    <div class="text-right">
                        <p class="text-sm text-slate-500">
                            Total Pembayaran
                        </p>
                        <p class="text-3xl font-extrabold text-violet-600">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- BACK --}}
            <div class="mt-10">
                <a href="{{ route('buyer.orders.history') }}"
                    class="inline-flex items-center
                      text-violet-600 hover:text-violet-800
                      font-semibold transition">
                    ← Kembali ke Riwayat Pembelian
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

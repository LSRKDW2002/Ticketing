<x-layouts.admin title="Detail Pemesanan">

    <div class="max-w-5xl mx-auto px-6 py-10">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-2">
            <div>
                <h1 class="text-3xl font-bold">
                    Detail Pemesanan
                </h1>
                <p class="text-base-content/60 mt-1">
                    Informasi lengkap transaksi pemesanan tiket
                </p>
            </div>

            <div class="text-sm text-base-content/60">
                Order <span class="font-medium">#{{ $order->id }}</span> •
                {{ $order->order_date->format('d M Y • H:i') }}
            </div>
        </div>

        {{-- CARD --}}
        <div class="bg-base-100 border border-base-300 rounded-2xl shadow-md overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-3">

                {{-- EVENT INFO --}}
                <div class="p-6 border-b lg:border-b-0 lg:border-r border-base-300">

                    {{-- IMAGE --}}
                    <div class="rounded-xl overflow-hidden border border-base-300 shadow-sm mb-4">
                        <img src="{{ $order->event?->gambar
                            ? asset('images/events/' . $order->event->gambar)
                            : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp' }}"
                            alt="{{ $order->event?->judul ?? 'Event' }}" class="w-full h-48 object-cover">
                    </div>

                    <h2 class="text-lg font-bold">
                        {{ $order->event?->judul ?? 'Event Tidak Ditemukan' }}
                    </h2>

                    <p class="text-sm text-base-content/60 mt-1">
                        {{ $order->event?->lokasi ?? '-' }}
                    </p>

                </div>

                {{-- ORDER DETAIL --}}
                <div class="lg:col-span-2 p-6">

                    <h3 class="text-xl font-semibold mb-4">
                        Rincian Tiket
                    </h3>

                    <div class="space-y-4">

                        @foreach ($order->detailOrders as $detail)
                            <div
                                class="flex items-center justify-between
                                        p-4 rounded-xl
                                        bg-base-200/50">

                                <div>
                                    <div class="font-semibold capitalize">
                                        {{ $detail->tiket->tipe }}
                                    </div>
                                    <div class="text-sm text-base-content/60">
                                        Qty: {{ $detail->jumlah }}
                                    </div>
                                </div>

                                <div class="font-semibold">
                                    Rp {{ number_format($detail->subtotal_harga, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="divider my-6"></div>

                    {{-- TOTAL --}}
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-lg font-semibold">
                            Total Pembayaran
                        </span>
                        <span class="text-2xl font-bold text-teal-600">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end">
                        <a href="{{ route('admin.histories.index') }}"
                            class="btn bg-teal-500 hover:bg-teal-600
                                  text-white font-semibold
                                  rounded-xl shadow">
                            Kembali ke Riwayat
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-layouts.admin>

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">

        <div class="max-w-6xl mx-auto px-4 py-12">

            {{-- EVENT HEADER --}}
            <div
                class="bg-white rounded-3xl
                    border border-slate-200
                    shadow-xl overflow-hidden mb-10">

                {{-- BANNER --}}
                <div class="relative h-80">
                    <img src="{{ asset('images/events/' . $event->gambar) }}" alt="{{ $event->judul }}"
                        class="w-full h-full object-cover">

                    {{-- CATEGORY --}}
                    <span
                        class="absolute top-5 left-5
                             bg-cyan-500 text-white text-sm
                             px-4 py-1.5 rounded-full shadow-lg">
                        {{ $event->kategori->nama }}
                    </span>
                </div>

                {{-- INFO --}}
                <div class="p-8">
                    <h1 class="text-4xl font-extrabold text-slate-900 mb-4">
                        {{ $event->judul }}
                    </h1>

                    <div
                        class="grid grid-cols-1 md:grid-cols-3 gap-4
                            text-sm text-slate-600 mb-6">
                        <div>{{ $event->lokasi }}</div>
                        <div>{{ $event->tanggal_waktu->format('d M Y • H:i') }}</div>
                        <div>{{ $event->tikets->count() }} Tipe Tiket</div>
                    </div>

                    <p class="text-slate-700 leading-relaxed">
                        {{ $event->deskripsi }}
                    </p>
                </div>
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <div
                    class="mb-8 p-4 rounded-xl
                        bg-red-100 text-red-700
                        border border-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- FORM TIKET --}}
            <form method="POST" action="{{ route('buyer.checkout') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div
                    class="bg-white rounded-3xl
                        border border-slate-200
                        shadow-xl p-8">

                    <h2 class="text-2xl font-bold text-slate-900 mb-8">
                        Pilih Tiket
                    </h2>

                    @if ($event->tikets->count())
                        <div class="space-y-5">

                            @foreach ($event->tikets as $index => $ticket)
                                <div
                                    class="flex flex-col md:flex-row
                                        md:items-center md:justify-between gap-6
                                        border border-slate-200
                                        rounded-2xl p-6">

                                    {{-- INFO --}}
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $ticket->tipe }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            Harga:
                                            <span class="font-semibold text-violet-600">
                                                Rp {{ number_format($ticket->harga, 0, ',', '.') }}
                                            </span>
                                        </p>

                                        <p class="text-sm text-slate-500">
                                            Stok tersedia: {{ $ticket->stok }}
                                        </p>
                                    </div>

                                    {{-- QTY --}}
                                    <div class="flex items-center gap-4">
                                        <input type="hidden" name="tickets[{{ $index }}][id]"
                                            value="{{ $ticket->id }}">

                                        <label class="text-sm text-slate-600">
                                            Jumlah
                                        </label>

                                        <input type="number" name="tickets[{{ $index }}][qty]" min="0"
                                            max="{{ $ticket->stok }}" value="0"
                                            class="w-24 rounded-xl
                                            text-black
                                               border-slate-300
                                               text-center
                                               focus:ring-violet-500
                                               focus:border-violet-500">
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- SUBMIT --}}
                        <div class="mt-10 flex justify-end">
                            <button type="submit"
                                class="px-10 py-3 rounded-xl
                                   bg-gradient-to-r from-violet-600 to-indigo-600
                                   text-white font-semibold
                                   hover:opacity-90 transition shadow-lg">
                                Beli Tiket
                            </button>
                        </div>
                    @else
                        <p class="text-slate-500">
                            Tiket belum tersedia untuk event ini.
                        </p>
                    @endif

                </div>
            </form>

        </div>
    </div>
</x-app-layout>

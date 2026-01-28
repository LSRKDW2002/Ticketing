<x-layouts.admin title="History Pembelian">

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold">
                History Pembelian
            </h1>
            <p class="text-base-content/60 mt-1">
                Daftar seluruh transaksi pembelian tiket
            </p>
        </div>

        {{-- TABLE --}}
        <div class="bg-base-100 border border-base-300 rounded-2xl shadow-sm overflow-x-auto">

            <table class="table table-zebra w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th class="w-16">No</th>
                        <th>Nama Pembeli</th>
                        <th>Event</th>
                        <th class="w-44">Tanggal Pembelian</th>
                        <th class="w-48">Total Harga</th>
                        <th class="w-32 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($histories as $index => $history)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="font-medium">
                                {{ $history->user->name }}
                            </td>

                            <td>
                                {{ $history->event?->judul ?? '-' }}
                            </td>

                            <td>
                                {{ $history->created_at->format('d M Y') }}
                            </td>

                            <td class="font-semibold">
                                Rp {{ number_format($history->total_harga, 0, ',', '.') }}
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <a href="{{ route('admin.histories.show', $history->id) }}"
                                    class="btn btn-sm w-24
                                          bg-sky-500 hover:bg-sky-600
                                          text-white font-medium
                                          rounded-lg shadow">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-base-content/60 py-12">
                                Tidak ada history pembelian tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</x-layouts.admin>

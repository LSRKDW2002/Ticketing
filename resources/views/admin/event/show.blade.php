<x-layouts.admin title="Detail Event">

    {{-- SUCCESS TOAST --}}
    @if (session('success'))
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert alert-success shadow-lg">
                <span>{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
        </script>
    @endif

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- PAGE HEADER --}}
        <div class="mb-10">
            <h1 class="text-3xl font-bold">
                Detail Event
            </h1>
            <p class="text-base-content/60 mt-1">
                Informasi lengkap event dan manajemen tiket
            </p>
        </div>

        {{-- EVENT INFO --}}
        <div class="bg-base-100 border border-base-300 rounded-2xl shadow-md mb-12">
            <div class="p-8 space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Judul Event</span>
                        </label>
                        <input class="input input-bordered rounded-xl" value="{{ $event->judul }}" disabled>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Kategori</span>
                        </label>
                        <input class="input input-bordered rounded-xl" value="{{ $event->kategori->nama }}" disabled>
                    </div>

                    <div class="form-control md:col-span-2">
                        <label class="label">
                            <span class="label-text font-medium">Deskripsi</span>
                        </label>
                        <textarea class="textarea textarea-bordered rounded-xl h-28" disabled>{{ $event->deskripsi }}</textarea>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Tanggal & Waktu</span>
                        </label>
                        <input class="input input-bordered rounded-xl"
                            value="{{ $event->tanggal_waktu->format('d M Y • H:i') }}" disabled>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Lokasi</span>
                        </label>
                        <input class="input input-bordered rounded-xl" value="{{ $event->lokasi }}" disabled>
                    </div>

                </div>

                {{-- IMAGE --}}
                @if ($event->gambar)
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Gambar Event</span>
                        </label>
                        <div class="max-w-lg rounded-xl overflow-hidden border border-base-300 shadow-sm">
                            <img src="{{ asset('images/events/' . $event->gambar) }}" class="w-full h-64 object-cover">
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- TICKET HEADER --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold">
                    List Ticket
                </h2>
                <p class="text-base-content/60">
                    Kelola tiket untuk event ini
                </p>
            </div>

            <button onclick="add_ticket_modal.showModal()"
                class="btn bg-teal-500 hover:bg-teal-600
                           text-white font-semibold
                           rounded-xl shadow">
                + Tambah Ticket
            </button>
        </div>

        {{-- TICKET TABLE --}}
        <div class="bg-base-100 border border-base-300 rounded-2xl shadow-sm overflow-x-auto">

            <table class="table table-zebra w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th class="w-16">No</th>
                        <th>Tipe</th>
                        <th class="w-40">Harga</th>
                        <th class="w-28">Stok</th>
                        <th class="w-72 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($tickets as $index => $ticket)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-medium capitalize">{{ $ticket->tipe }}</td>
                            <td>Rp {{ number_format($ticket->harga, 0, ',', '.') }}</td>
                            <td>{{ $ticket->stok }}</td>

                            <td class="text-center">
                                <div class="flex justify-center gap-3">

                                    {{-- EDIT --}}
                                    <button
                                        class="btn btn-sm w-24
                                               bg-amber-500 hover:bg-amber-600
                                               text-white rounded-lg shadow"
                                        onclick="openEditModal(this)" data-id="{{ $ticket->id }}"
                                        data-tipe="{{ $ticket->tipe }}" data-harga="{{ $ticket->harga }}"
                                        data-stok="{{ $ticket->stok }}">
                                        Edit
                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                        class="btn btn-sm w-24
                                               bg-red-600 hover:bg-red-700
                                               text-white rounded-lg shadow"
                                        onclick="openDeleteModal(this)" data-id="{{ $ticket->id }}">
                                        Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-base-content/60 py-10">
                                Belum ada ticket untuk event ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ADD TICKET MODAL --}}
    <dialog id="add_ticket_modal" class="modal">
        <form method="POST" action="{{ route('admin.tickets.store') }}" class="modal-box rounded-2xl">
            @csrf

            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <h3 class="text-lg font-bold mb-4">Tambah Ticket</h3>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-medium">Tipe Ticket</span>
                </label>
                <select name="tipe" class="select select-bordered rounded-xl" required>
                    <option disabled selected>Pilih Tipe</option>
                    <option value="reguler">Reguler</option>
                    <option value="premium">Premium</option>
                </select>
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-medium">Harga</span>
                </label>
                <input type="number" name="harga" class="input input-bordered rounded-xl" required>
            </div>

            <div class="form-control mb-6">
                <label class="label">
                    <span class="label-text font-medium">Stok</span>
                </label>
                <input type="number" name="stok" class="input input-bordered rounded-xl" required>
            </div>

            <div class="modal-action">
                <button class="btn bg-teal-500 hover:bg-teal-600 text-white rounded-xl">
                    Tambah
                </button>
                <button type="reset" class="btn btn-ghost rounded-xl" onclick="add_ticket_modal.close()">
                    Batal
                </button>
            </div>
        </form>
    </dialog>

    {{-- EDIT TICKET MODAL --}}
    <dialog id="edit_ticket_modal" class="modal">
        <form method="POST" class="modal-box rounded-2xl">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_ticket_id">

            <h3 class="text-lg font-bold mb-4">Edit Ticket</h3>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-medium">Tipe Ticket</span>
                </label>
                <select id="edit_tipe" name="tipe" class="select select-bordered rounded-xl">
                    <option value="reguler">Reguler</option>
                    <option value="premium">Premium</option>
                </select>
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-medium">Harga</span>
                </label>
                <input id="edit_harga" name="harga" type="number" class="input input-bordered rounded-xl">
            </div>

            <div class="form-control mb-6">
                <label class="label">
                    <span class="label-text font-medium">Stok</span>
                </label>
                <input id="edit_stok" name="stok" type="number" class="input input-bordered rounded-xl">
            </div>

            <div class="modal-action">
                <button class="btn bg-amber-500 hover:bg-amber-600 text-white rounded-xl">
                    Simpan
                </button>
                <button type="reset" class="btn btn-ghost rounded-xl" onclick="edit_ticket_modal.close()">
                    Batal
                </button>
            </div>
        </form>
    </dialog>

    {{-- DELETE MODAL --}}
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box rounded-2xl">
            @csrf
            @method('DELETE')

            <input type="hidden" id="delete_ticket_id">

            <h3 class="text-lg font-bold mb-2">Hapus Ticket</h3>
            <p class="text-base-content/70">
                Apakah Anda yakin ingin menghapus ticket ini?
            </p>

            <div class="modal-action">
                <button class="btn bg-red-600 hover:bg-red-700 text-white rounded-xl">
                    Hapus
                </button>
                <button type="reset" class="btn btn-ghost rounded-xl" onclick="delete_modal.close()">
                    Batal
                </button>
            </div>
        </form>
    </dialog>

    {{-- SCRIPT --}}
    <script>
        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');
            document.getElementById('delete_ticket_id').value = id;
            form.action = `/admin/tickets/${id}`;
            delete_modal.showModal();
        }

        function openEditModal(button) {
            const id = button.dataset.id;
            const tipe = button.dataset.tipe;
            const harga = button.dataset.harga;
            const stok = button.dataset.stok;

            const form = document.querySelector('#edit_ticket_modal form');
            document.getElementById('edit_ticket_id').value = id;
            document.getElementById('edit_tipe').value = tipe;
            document.getElementById('edit_harga').value = harga;
            document.getElementById('edit_stok').value = stok;

            form.action = `/admin/tickets/${id}`;
            edit_ticket_modal.showModal();
        }
    </script>

</x-layouts.admin>

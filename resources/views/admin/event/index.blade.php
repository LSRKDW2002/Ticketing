<x-layouts.admin title="Manajemen Event">

    {{-- TOAST SUCCESS --}}
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

    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold">
                    Manajemen Event
                </h1>
                <p class="text-base-content/60 mt-1">
                    Kelola seluruh event yang tersedia
                </p>
            </div>

            {{-- TAMBAH EVENT --}}
            <a href="{{ route('admin.events.create') }}"
                class="btn bg-teal-500 hover:bg-teal-600
                      text-white font-semibold
                      rounded-xl shadow">
                + Tambah Event
            </a>
        </div>

        {{-- TABLE --}}
        <div class="rounded-2xl bg-base-100 border border-base-300 shadow-sm overflow-x-auto">

            <table class="table table-zebra w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th class="w-16">No</th>
                        <th class="min-w-[220px]">Judul</th>
                        <th>Kategori</th>
                        <th class="w-36">Tanggal</th>
                        <th class="min-w-[180px]">Lokasi</th>
                        <th class="w-72 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($events as $index => $event)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="font-medium">
                                {{ $event->judul }}
                            </td>

                            <td>
                                <span class="badge badge-outline">
                                    {{ $event->kategori->nama }}
                                </span>
                            </td>

                            <td>
                                {{ $event->tanggal_waktu->format('d M Y') }}
                            </td>

                            <td>
                                {{ $event->lokasi }}
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="flex justify-center gap-3">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.events.show', $event->id) }}"
                                        class="btn btn-sm w-24
                                              bg-sky-500 hover:bg-sky-600
                                              text-white font-medium
                                              rounded-lg shadow">
                                        Detail
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.events.edit', $event->id) }}"
                                        class="btn btn-sm w-24
                                              bg-amber-500 hover:bg-amber-600
                                              text-white font-medium
                                              rounded-lg shadow">
                                        Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <button
                                        class="btn btn-sm w-24
                                               bg-red-600 hover:bg-red-700
                                               text-white font-medium
                                               rounded-lg shadow"
                                        onclick="openDeleteModal(this)" data-id="{{ $event->id }}">
                                        Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-base-content/60 py-10">
                                Tidak ada event tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- DELETE MODAL --}}
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box rounded-2xl">
            @csrf
            @method('DELETE')

            <input type="hidden" id="delete_event_id">

            <h3 class="text-lg font-bold mb-2">
                Hapus Event
            </h3>

            <p class="text-base-content/70">
                Apakah Anda yakin ingin menghapus event ini?
            </p>

            <div class="modal-action">
                <button class="btn bg-red-600 hover:bg-red-700
                           text-white rounded-xl shadow"
                    type="submit">
                    Hapus
                </button>
                <button class="btn btn-ghost rounded-xl" type="reset" onclick="delete_modal.close()">
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

            document.getElementById('delete_event_id').value = id;
            form.action = `/admin/events/${id}`;

            delete_modal.showModal();
        }
    </script>

</x-layouts.admin>

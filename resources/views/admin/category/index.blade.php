<x-layouts.admin title="Manajemen Kategori">

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
                    Manajemen Kategori
                </h1>
                <p class="text-base-content/60 mt-1">
                    Kelola kategori event yang tersedia
                </p>
            </div>

            {{-- TOMBOL TAMBAH (CYAN / TEAL) --}}
            <button
                class="btn bg-teal-500 hover:bg-teal-600
                       text-white font-semibold
                       rounded-xl shadow"
                onclick="add_modal.showModal()">
                + Tambah Kategori
            </button>
        </div>

        {{-- TABLE --}}
        <div class="rounded-2xl bg-base-100 border border-base-300 shadow-sm overflow-x-auto">

            <table class="table table-zebra w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th class="w-16">No</th>
                        <th>Nama Kategori</th>
                        <th class="w-56 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="font-medium">
                                {{ $category->nama }}
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="flex justify-center gap-3">

                                    {{-- EDIT (LEBAR SAMA) --}}
                                    <button
                                        class="btn btn-sm w-24
                                               bg-amber-500 hover:bg-amber-600
                                               text-white font-medium
                                               rounded-lg shadow"
                                        onclick="openEditModal(this)" data-id="{{ $category->id }}"
                                        data-nama="{{ $category->nama }}">
                                        Edit
                                    </button>

                                    {{-- DELETE (LEBAR SAMA) --}}
                                    <button
                                        class="btn btn-sm w-24
                                               bg-red-600 hover:bg-red-700
                                               text-white font-medium
                                               rounded-lg shadow"
                                        onclick="openDeleteModal(this)" data-id="{{ $category->id }}">
                                        Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-base-content/60 py-10">
                                Tidak ada kategori tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- ADD MODAL --}}
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="modal-box rounded-2xl">
            @csrf

            <h3 class="text-lg font-bold mb-4">
                Tambah Kategori
            </h3>

            <div class="form-control w-full mb-6">
                <label class="label">
                    <span class="label-text font-medium">
                        Nama Kategori
                    </span>
                </label>
                <input type="text" name="nama" placeholder="Contoh: Musik, Seminar, Olahraga"
                    class="input input-bordered w-full rounded-xl" required />
            </div>

            <div class="modal-action">
                <button
                    class="btn bg-teal-500 hover:bg-teal-600
                           text-white rounded-xl shadow"
                    type="submit">
                    Simpan
                </button>
                <button class="btn btn-ghost rounded-xl" type="reset" onclick="add_modal.close()">
                    Batal
                </button>
            </div>
        </form>
    </dialog>

    {{-- EDIT MODAL --}}
    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box rounded-2xl">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_category_id">

            <h3 class="text-lg font-bold mb-4">
                Edit Kategori
            </h3>

            <div class="form-control w-full mb-6">
                <label class="label">
                    <span class="label-text font-medium">
                        Nama Kategori
                    </span>
                </label>
                <input type="text" id="edit_category_name" name="nama"
                    class="input input-bordered w-full rounded-xl" required />
            </div>

            <div class="modal-action">
                <button
                    class="btn bg-amber-500 hover:bg-amber-600
                           text-white rounded-xl shadow"
                    type="submit">
                    Simpan
                </button>
                <button class="btn btn-ghost rounded-xl" type="reset" onclick="edit_modal.close()">
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

            <input type="hidden" id="delete_category_id">

            <h3 class="text-lg font-bold mb-2">
                Hapus Kategori
            </h3>
            <p class="text-base-content/70">
                Apakah Anda yakin ingin menghapus kategori ini?
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
        function openEditModal(button) {
            const id = button.dataset.id;
            const name = button.dataset.nama;
            const form = document.querySelector('#edit_modal form');

            document.getElementById('edit_category_id').value = id;
            document.getElementById('edit_category_name').value = name;
            form.action = `/admin/categories/${id}`;

            edit_modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');

            document.getElementById('delete_category_id').value = id;
            form.action = `/admin/categories/${id}`;

            delete_modal.showModal();
        }
    </script>

</x-layouts.admin>

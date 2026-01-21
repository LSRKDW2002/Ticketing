<x-layouts.admin title="Manajemen Tipe Pembayaran">

    {{-- SUCCESS TOAST --}}
    @if (session('success'))
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert alert-success text-black shadow-lg">
                {{ session('success') }}
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
        </script>
    @endif

    <div class="container mx-auto p-10">

        {{-- HEADER --}}
        <div class="flex items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">
                    Manajemen Tipe Pembayaran
                </h1>
                <p class="text-base-content/60 mt-1">
                    Kelola metode pembayaran yang tersedia
                </p>
            </div>

            <button onclick="add_modal.showModal()"
                class="ml-auto btn
                       bg-emerald-400 text-black
                       hover:bg-emerald-500
                       border-none">
                + Tambah Tipe Pembayaran
            </button>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto bg-base-100 rounded-2xl shadow border border-base-300">
            <table class="table">
                <thead class="bg-base-200 text-black">
                    <tr>
                        <th class="w-16">No</th>
                        <th>Nama Tipe Pembayaran</th>
                        <th class="w-56 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paymentTypes as $i => $type)
                        <tr class="hover:bg-base-200 transition">
                            <td>{{ $i + 1 }}</td>
                            <td class="font-medium">{{ $type->nama }}</td>
                            <td>
                                <div class="flex justify-center gap-3">

                                    {{-- EDIT --}}
                                    <button
                                        class="btn btn-sm w-24
                                               bg-amber-400 text-black
                                               hover:bg-amber-500
                                               border-none"
                                        onclick="openEditModal({{ $type->id }}, '{{ $type->nama }}')">
                                        Edit
                                    </button>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.payment-types.destroy', $type->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="btn btn-sm w-24
                                                   bg-red-500 text-black
                                                   hover:bg-red-600
                                                   border-none"
                                            onclick="return confirm('Hapus tipe pembayaran ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-base-content/60">
                                Belum ada tipe pembayaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ADD MODAL --}}
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.payment-types.store') }}" class="modal-box rounded-2xl">
            @csrf

            <h3 class="font-bold text-xl mb-6">
                Tambah Tipe Pembayaran
            </h3>

            <div class="form-control mb-6">
                <label class="label">
                    <span class="label-text font-medium">Nama Tipe Pembayaran</span>
                </label>
                <input type="text" name="nama" class="input input-bordered w-full"
                    placeholder="Contoh: Transfer Bank" required>
            </div>

            <div class="modal-action">
                <button
                    class="btn w-28
                           bg-emerald-400 text-black
                           hover:bg-emerald-500
                           border-none">
                    Simpan
                </button>
                <button type="button" onclick="add_modal.close()"
                    class="btn w-28
                           bg-slate-300 text-black
                           hover:bg-slate-400
                           border-none">
                    Batal
                </button>
            </div>
        </form>
    </dialog>

    {{-- EDIT MODAL --}}
    <dialog id="edit_modal" class="modal">
        <form method="POST" id="editForm" class="modal-box rounded-2xl">
            @csrf
            @method('PUT')

            <h3 class="font-bold text-xl mb-6">
                Edit Tipe Pembayaran
            </h3>

            <div class="form-control mb-6">
                <label class="label">
                    <span class="label-text font-medium">Nama Tipe Pembayaran</span>
                </label>
                <input type="text" name="nama" id="edit_nama" class="input input-bordered w-full" required>
            </div>

            <div class="modal-action">
                <button
                    class="btn w-28
                           bg-sky-400 text-black
                           hover:bg-sky-500
                           border-none">
                    Update
                </button>
                <button type="button" onclick="edit_modal.close()"
                    class="btn w-28
                           bg-slate-300 text-black
                           hover:bg-slate-400
                           border-none">
                    Batal
                </button>
            </div>
        </form>
    </dialog>

    {{-- SCRIPT --}}
    <script>
        function openEditModal(id, nama) {
            document.getElementById('edit_nama').value = nama;
            document.getElementById('editForm').action = `/admin/payment-types/${id}`;
            edit_modal.showModal();
        }
    </script>

</x-layouts.admin>

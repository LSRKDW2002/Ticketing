<x-layouts.admin title="Tambah Event Baru">

    {{-- ERROR TOAST --}}
    @if ($errors->any())
        <div class="toast toast-bottom toast-end z-50">
            <div class="alert alert-error shadow-lg">
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 5000)
        </script>
    @endif

    <div class="max-w-5xl mx-auto px-6 py-10">

        {{-- PAGE HEADER --}}
        <div class="mb-10">
            <h1 class="text-3xl font-bold">
                Tambah Event Baru
            </h1>
            <p class="text-base-content/60 mt-1">
                Lengkapi informasi event yang akan ditampilkan ke pengguna
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-base-100 border border-base-300
                    rounded-2xl shadow-md">

            <form id="eventForm" method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data"
                class="p-8 space-y-8">
                @csrf

                {{-- INFORMASI UTAMA --}}
                <section>
                    <h2 class="text-lg font-semibold mb-4">
                        Informasi Utama
                    </h2>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text font-medium">
                                Judul Event
                            </span>
                        </label>
                        <input type="text" name="judul" placeholder="Contoh: Konser Musik Rock Nasional"
                            class="input input-bordered w-full rounded-xl" required>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">
                                Deskripsi Event
                            </span>
                        </label>
                        <textarea name="deskripsi" placeholder="Tuliskan deskripsi lengkap mengenai event ini..."
                            class="textarea textarea-bordered
                                   h-32 w-full rounded-xl" required></textarea>
                    </div>
                </section>

                <div class="divider"></div>

                {{-- DETAIL EVENT --}}
                <section>
                    <h2 class="text-lg font-semibold mb-4">
                        Detail Event
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">
                                    Tanggal & Waktu
                                </span>
                            </label>
                            <input type="datetime-local" name="tanggal_waktu"
                                class="input input-bordered w-full rounded-xl" required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">
                                    Lokasi
                                </span>
                            </label>
                            <input type="text" name="lokasi" placeholder="Contoh: Stadion Utama Gelora Bung Karno"
                                class="input input-bordered w-full rounded-xl" required>
                        </div>

                        <div class="form-control md:col-span-2">
                            <label class="label">
                                <span class="label-text font-medium">
                                    Kategori Event
                                </span>
                            </label>
                            <select name="kategori_id" class="select select-bordered w-full rounded-xl" required>
                                <option value="" disabled selected>
                                    Pilih kategori event
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </section>

                <div class="divider"></div>

                {{-- MEDIA EVENT --}}
                <section>
                    <h2 class="text-lg font-semibold mb-4">
                        Media Event
                    </h2>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text font-medium">
                                Gambar Event
                            </span>
                        </label>
                        <input type="file" name="gambar" accept="image/*"
                            class="file-input file-input-bordered
                                   w-full rounded-xl"
                            required>
                        <label class="label">
                            <span class="label-text-alt text-base-content/60">
                                JPG, PNG, WEBP • Maksimal 5MB
                            </span>
                        </label>
                    </div>

                    {{-- PREVIEW --}}
                    <div id="imagePreview" class="hidden">
                        <label class="label">
                            <span class="label-text font-medium">
                                Preview Gambar
                            </span>
                        </label>

                        <div
                            class="mt-3 max-w-md
                                    rounded-xl overflow-hidden
                                    border border-base-300
                                    shadow-sm">
                            <img id="previewImg" src="" alt="Preview" class="w-full h-56 object-cover">
                        </div>
                    </div>
                </section>

                {{-- ACTION --}}
                <div class="flex justify-end gap-4 pt-6">

                    <button type="reset" class="btn btn-ghost rounded-xl">
                        Reset
                    </button>

                    <button type="submit"
                        class="btn bg-teal-500 hover:bg-teal-600
                               text-white font-semibold
                               rounded-xl px-8 shadow">
                        Simpan Event
                    </button>

                </div>

            </form>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        const form = document.getElementById('eventForm');
        const fileInput = form.querySelector('input[type="file"]');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        form.addEventListener('reset', function() {
            imagePreview.classList.add('hidden');
            previewImg.src = '';
        });
    </script>

</x-layouts.admin>

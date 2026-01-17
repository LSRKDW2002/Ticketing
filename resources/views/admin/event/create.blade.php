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

    <div class="container mx-auto px-6 py-10 max-w-5xl">

        {{-- PAGE HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold">
                Tambah Event Baru
            </h1>
            <p class="text-base-content/60 mt-1">
                Lengkapi informasi event yang akan ditampilkan ke pengguna
            </p>
        </div>

        {{-- CARD FORM --}}
        <div class="card bg-base-100 shadow-md border border-base-200">
            <div class="card-body p-8 space-y-6">

                <form id="eventForm" method="post" action="{{ route('admin.events.store') }}"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- SECTION: BASIC INFO --}}
                    <div>
                        <h2 class="text-lg font-semibold mb-4">
                            Informasi Utama
                        </h2>

                        {{-- Judul --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-medium">Judul Event</span>
                            </label>
                            <input type="text" name="judul" placeholder="Contoh: Konser Musik Rock Nasional"
                                class="input input-bordered w-full" required>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Deskripsi Event</span>
                            </label>
                            <textarea name="deskripsi" placeholder="Tuliskan deskripsi lengkap mengenai event ini..."
                                class="textarea textarea-bordered h-28 w-full" required></textarea>
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- SECTION: DETAIL EVENT --}}
                    <div>
                        <h2 class="text-lg font-semibold mb-4">
                            Detail Event
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Tanggal --}}
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Tanggal & Waktu</span>
                                </label>
                                <input type="datetime-local" name="tanggal_waktu" class="input input-bordered w-full"
                                    required>
                            </div>

                            {{-- Lokasi --}}
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Lokasi</span>
                                </label>
                                <input type="text" name="lokasi"
                                    placeholder="Contoh: Stadion Utama Gelora Bung Karno"
                                    class="input input-bordered w-full" required>
                            </div>

                            {{-- Kategori --}}
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text font-medium">Kategori Event</span>
                                </label>
                                <select name="kategori_id" class="select select-bordered w-full" required>
                                    <option value="" disabled selected>Pilih kategori event</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- SECTION: IMAGE --}}
                    <div>
                        <h2 class="text-lg font-semibold mb-4">
                            Media Event
                        </h2>

                        {{-- Upload --}}
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-medium">Gambar Event</span>
                            </label>
                            <input type="file" name="gambar" accept="image/*"
                                class="file-input file-input-bordered w-full" required>
                            <label class="label">
                                <span class="label-text-alt text-base-content/60">
                                    JPG, PNG, WEBP • Maksimal 5MB
                                </span>
                            </label>
                        </div>

                        {{-- Preview --}}
                        <div id="imagePreview" class="hidden">
                            <label class="label">
                                <span class="label-text font-medium">Preview Gambar</span>
                            </label>
                            <div class="mt-2 rounded-xl overflow-hidden border border-base-200 max-w-md">
                                <img id="previewImg" src="" alt="Preview" class="w-full object-cover">
                            </div>
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="reset" class="btn btn-ghost">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary px-8">
                            Simpan Event
                        </button>
                    </div>

                </form>
            </div>
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

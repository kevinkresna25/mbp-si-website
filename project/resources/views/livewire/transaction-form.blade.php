<div>
    <form wire:submit="save" class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">
                {{ $editMode ? 'Edit Transaksi' : 'Tambah Transaksi Baru' }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal" wire:model="tanggal"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                        max="{{ date('Y-m-d') }}">
                    @error('tanggal') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Jenis Transaksi --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Transaksi <span class="text-red-500">*</span></label>
                    <select id="type" wire:model="type"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($this->transactionTypes as $transactionType)
                            <option value="{{ $transactionType->value }}">{{ $transactionType->label() }}</option>
                        @endforeach
                    </select>
                    @error('type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Kategori ZISWAF --}}
                <div>
                    <label for="category_ziswaf" class="block text-sm font-medium text-gray-700 mb-1">Kategori ZISWAF <span class="text-red-500">*</span></label>
                    <select id="category_ziswaf" wire:model="category_ziswaf"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($this->categoryZiswafOptions as $category)
                            <option value="{{ $category->value }}">{{ $category->label() }} - {{ $category->description() }}</option>
                        @endforeach
                    </select>
                    @error('category_ziswaf') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Detail Kategori --}}
                <div>
                    <label for="category_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Kategori <span class="text-red-500">*</span></label>
                    <input type="text" id="category_detail" wire:model="category_detail"
                        placeholder="Contoh: Infaq Jumat, Bayar Listrik..."
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    @error('category_detail') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Nominal --}}
                <div>
                    <label for="nominal" class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" id="nominal" wire:model="nominal"
                        placeholder="0" min="1" step="1"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    @error('nominal') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Bukti Foto --}}
                <div>
                    <label for="bukti_foto" class="block text-sm font-medium text-gray-700 mb-1">Bukti Foto</label>
                    <input type="file" id="bukti_foto" wire:model="bukti_foto" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    @if($bukti_foto)
                        <p class="mt-1 text-xs text-emerald-600">Preview tersedia setelah upload.</p>
                    @elseif($existing_bukti_foto)
                        <p class="mt-1 text-xs text-gray-500">File saat ini: {{ basename($existing_bukti_foto) }}</p>
                    @endif
                    @error('bukti_foto') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="mt-6">
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <textarea id="keterangan" wire:model="keterangan" rows="3"
                    placeholder="Keterangan tambahan (opsional)..."
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"></textarea>
                @error('keterangan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('admin.transactions.index') }}" wire:navigate
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition disabled:opacity-50"
                wire:loading.attr="disabled">
                <span wire:loading.remove>{{ $editMode ? 'Simpan Perubahan' : 'Simpan Transaksi' }}</span>
                <span wire:loading>Menyimpan...</span>
            </button>
        </div>
    </form>
</div>

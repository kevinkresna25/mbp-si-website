<x-admin-layout>
    <x-slot name="header">Media Sosial</x-slot>

    <div class="max-w-4xl" x-data="{
        showCreateModal: false,
        showEditModal: false,
        editingLink: {},
        platformPresets: ['Instagram', 'YouTube', 'Facebook', 'WhatsApp', 'TikTok', 'Twitter', 'Telegram', 'LinkedIn', 'Website', 'Email', 'Custom'],
        
        edit(link) {
            this.editingLink = link;
            this.showEditModal = true;
        }
    }">
        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Media Sosial</h2>
                    <p class="text-sm text-gray-500">Atur urutan dengan drag & drop</p>
                </div>
                <button @click="showCreateModal = true" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition flex items-center shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Media Sosial
                </button>
            </div>

            <div class="p-0">
                @if($links->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    Belum ada media sosial yang ditambahkan.
                </div>
                @else
                <ul id="social-links-list" class="divide-y divide-gray-100">
                    @foreach($links as $link)
                    <li class="group flex items-center justify-between p-4 hover:bg-gray-50 transition cursor-move" data-id="{{ $link->id }}">
                        <div class="flex items-center">
                            <div class="mr-4 text-gray-400 cursor-grab active:cursor-grabbing p-1 rounded hover:bg-gray-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mr-4 text-gray-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="{{ $link->getIconSvg() }}"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900 flex items-center">
                                    {{ $link->platform === 'Custom' ? $link->label : $link->platform }}
                                    @if(!$link->is_active)
                                    <span class="ml-2 px-2 py-0.5 bg-gray-100 text-gray-500 text-xs rounded-full">Nonaktif</span>
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-500 truncate max-w-md">{{ $link->url }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="edit({{ $link }})" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus link ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        {{-- Create Modal --}}
        <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showCreateModal" @click="showCreateModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <form action="{{ route('admin.social-links.store') }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Tambah Media Sosial</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Platform</label>
                                    <select name="platform" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" x-data="{}" @change="$el.value === 'WhatsApp' ? document.getElementById('url_hint').classList.remove('hidden') : document.getElementById('url_hint').classList.add('hidden')">
                                        <template x-for="p in platformPresets">
                                            <option :value="p" x-text="p"></option>
                                        </template>
                                    </select>
                                </div>
                                <div id="url_hint" class="hidden text-xs text-amber-600 bg-amber-50 p-2 rounded">
                                    Tips: Masukkan nomor WA lengkap dengan kode negara, misal: <code>https://wa.me/62812345678</code>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">URL / Link</label>
                                    <input type="url" name="url" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="https://...">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Label (Opsional)</label>
                                    <input type="text" name="label" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Follow Instagram Kami">
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan nama platform default.</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                            <button type="button" @click="showCreateModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditModal" @click="showEditModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <form :action="`{{ url('admin/social-links') }}/${editingLink.id}`" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Media Sosial</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Platform</label>
                                    <select name="platform" x-model="editingLink.platform" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        <template x-for="p in platformPresets">
                                            <option :value="p" x-text="p"></option>
                                        </template>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">URL / Link</label>
                                    <input type="url" name="url" x-model="editingLink.url" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                                    <input type="text" name="label" x-model="editingLink.label" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                </div>
                                <div class="flex items-center">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" x-model="editingLink.is_active" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                                    <label class="ml-2 block text-sm text-gray-900">Aktifkan Link Ini</label>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Simpan Perubahan</button>
                            <button type="button" @click="showEditModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SortableJS --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('social-links-list');
        if(el) {
            Sortable.create(el, {
                animation: 150,
                handle: '.cursor-grab',
                onEnd: function (evt) {
                    var itemEl = evt.item;
                    var newIndex = evt.newIndex;
                    var oldIndex = evt.oldIndex;
                    
                    var ids = [];
                    document.querySelectorAll('#social-links-list li').forEach(function(li) {
                        ids.push(li.getAttribute('data-id'));
                    });

                    // Send reorder request
                    fetch('{{ route("admin.social-links.reorder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ids: ids })
                    });
                }
            });
        }
    });
    </script>
</x-admin-layout>

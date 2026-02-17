<x-admin-layout>
    <x-slot name="header">Pengaturan Situs</x-slot>

    <div class="max-w-3xl">
        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.site-settings.update') }}">
            @csrf
            @method('PUT')

            @php
                $groupLabels = [
                    'umum' => ['label' => 'Umum', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z', 'icon2' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                    'kontak' => ['label' => 'Kontak & Lokasi', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                ];
                $hiddenKeys = ['map_latitude', 'map_longitude', 'google_maps_embed', 'office_hours'];
            @endphp

            @foreach($settings as $group => $items)
            @if($group === 'sosmed') @continue @endif
            @php $meta = $groupLabels[$group] ?? ['label' => ucfirst($group), 'icon' => 'M4 6h16M4 12h16M4 18h16']; @endphp
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center mb-5">
                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $meta['icon'] }}"/>
                            @if(isset($meta['icon2']))
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $meta['icon2'] }}"/>
                            @endif
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $meta['label'] }}</h2>
                </div>

                <div class="space-y-4">
                    @foreach($items as $setting)
                        @if(in_array($setting->key, $hiddenKeys)) @continue @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $setting->label }}</label>
                            @if($setting->type === 'textarea')
                                <textarea name="settings[{{ $setting->key }}]" rows="3"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                >{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                            @else
                                <input type="{{ $setting->type ?? 'text' }}" name="settings[{{ $setting->key }}]"
                                    value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm"
                                >
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Structured Office Hours for Kontak group --}}
                @if($group === 'kontak')
                <div class="mt-6 pt-6 border-t border-gray-200" x-data="{
                    rows: {{ old('settings.office_hours', $items->firstWhere('key', 'office_hours')?->value) ?: '[]' }},
                    days: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    times: [],
                    init() {
                        for(let h=0; h<24; h++) {
                            for(let m of ['00', '30']) {
                                let time = `${h.toString().padStart(2, '0')}:${m}`;
                                this.times.push(time);
                            }
                        }
                        if (typeof this.rows === 'string') {
                            try { this.rows = JSON.parse(this.rows); } catch(e) { this.rows = []; }
                        }
                        if (!this.rows.length) this.add();
                    },
                    add() {
                        this.rows.push({
                            day_start: 'Senin', day_end: 'Jumat',
                            time_open: '08:00', time_close: '16:00',
                            is_closed: false
                        });
                    },
                    remove(index) {
                        this.rows.splice(index, 1);
                    }
                }">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Jam Operasional Sekretariat</label>
                    <div class="space-y-3">
                        <template x-for="(row, index) in rows" :key="index">
                            <div class="flex flex-wrap md:flex-nowrap gap-2 items-start bg-gray-50 p-3 rounded-lg border border-gray-200">
                                <div class="grid grid-cols-2 gap-2 w-full md:w-auto flex-grow">
                                    <select x-model="row.day_start" class="rounded-md border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <template x-for="day in days">
                                            <option :value="day" x-text="day" :selected="row.day_start === day"></option>
                                        </template>
                                    </select>
                                    <select x-model="row.day_end" class="rounded-md border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <template x-for="day in days">
                                            <option :value="day" x-text="day" :selected="row.day_end === day"></option>
                                        </template>
                                    </select>
                                </div>

                                <div class="flex items-center gap-2 w-full md:w-auto" x-show="!row.is_closed">
                                    <select x-model="row.time_open" class="rounded-md border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <template x-for="t in times"><option :value="t" x-text="t" :selected="row.time_open === t"></option></template>
                                    </select>
                                    <span class="text-gray-400">-</span>
                                    <select x-model="row.time_close" class="rounded-md border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <template x-for="t in times"><option :value="t" x-text="t" :selected="row.time_close === t"></option></template>
                                    </select>
                                </div>

                                <div class="flex items-center gap-3 w-full md:w-auto md:ml-auto pt-1 md:pt-0">
                                    <label class="flex items-center text-sm text-gray-600 cursor-pointer select-none">
                                        <input type="checkbox" x-model="row.is_closed" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 mr-2">
                                        Tutup
                                    </label>
                                    <button type="button" @click="remove(index)" class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="add()" class="mt-3 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        + Tambah Jadwal
                    </button>
                    <input type="hidden" name="settings[office_hours]" :value="JSON.stringify(rows)">
                </div>
                @endif

                {{-- Google Maps Embed for Kontak group --}}
                @if($group === 'kontak')
                <div class="mt-6 pt-6 border-t border-gray-200" x-data="{
                    embedInput: `{{ old('settings.google_maps_embed', $items->firstWhere('key', 'google_maps_embed')?->value ?? '') }}`,
                    embedUrl: `{{ old('settings.google_maps_embed', $items->firstWhere('key', 'google_maps_embed')?->value ?? '') }}`,
                    parseEmbed() {
                        let val = this.embedInput.trim();
                        const match = val.match(/src=[&quot;']([^&quot;']+)[&quot;']/);
                        if (match) {
                            this.embedUrl = match[1];
                        } else if (val.startsWith('https://')) {
                            this.embedUrl = val;
                        }
                    }
                }">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Google Maps Embed</label>
                    <p class="text-xs text-gray-400 mb-3">
                        Buka <a href="https://www.google.com/maps" target="_blank" class="text-emerald-600 underline">Google Maps</a>
                        &rarr; cari lokasi &rarr; klik <strong>Bagikan</strong> &rarr; tab <strong>Sematkan peta</strong>
                        &rarr; salin kode &lt;iframe&gt; lalu paste di bawah.
                    </p>
                    <textarea x-model="embedInput" @input="parseEmbed()" rows="3"
                        placeholder='Paste kode <iframe> dari Google Maps...'
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm font-mono text-xs"></textarea>
                    <input type="hidden" name="settings[google_maps_embed]" :value="embedUrl">

                    {{-- Preview --}}
                    <template x-if="embedUrl">
                        <div class="mt-3">
                            <p class="text-xs text-gray-400 mb-2">Preview:</p>
                            <div class="rounded-lg overflow-hidden border border-gray-200">
                                <iframe :src="embedUrl" width="100%" height="250" style="border:0;"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </template>
                </div>
                @endif
            </div>
            @endforeach

            <div class="flex items-center justify-end space-x-3 mt-6">
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition shadow-sm">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

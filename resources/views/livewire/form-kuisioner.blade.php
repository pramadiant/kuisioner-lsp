<div class="max-w-4xl mx-auto p-6 mt-10">
    @if($isSubmitted)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Terima Kasih!</strong>
            <span class="block sm:inline">Data kuisioner Anda berhasil disimpan.</span>
        </div>
    @else
        <form wire:submit="submit" class="space-y-8">
            
            <!-- PESAN ERROR UMUM -->
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong>Terdapat Kesalahan:</strong> Mohon periksa kembali isian Anda.
                </div>
            @endif

            <!-- BAGIAN 1: DEMOGRAFI -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-4 text-indigo-600 border-b pb-2">Bagian 1: Identifikasi Demografi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 mt-1">Satu email hanya dapat mengisi satu kali.</p>
                    </div>

                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                        @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select wire:model="jenis_kelamin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Usia -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Usia (15 - 70 Tahun) <span class="text-red-500">*</span></label>
                        <input type="number" wire:model="usia" min="15" max="70" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                        @error('usia') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status Pernikahan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Pernikahan <span class="text-red-500">*</span></label>
                        <select wire:model="status_pernikahan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                            <option value="">-- Pilih --</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Bercerai">Bercerai</option>
                        </select>
                        @error('status_pernikahan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Punya Anak -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apakah anda telah memiliki anak?</label>
                        <select wire:model.live="punya_anak" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                            <option value="">-- Pilih --</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    @if($punya_anak === 'Ya')
                    <!-- Jumlah Anak -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Berapa jumlah anak anda?</label>
                        <input type="number" wire:model="jumlah_anak" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                    </div>
                    @endif

                    <div class="col-span-1 md:col-span-2 mt-4">
                        <h4 class="font-semibold text-gray-700 mb-2">Alamat Saat Ini</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Dropdown Provinsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Provinsi <span class="text-red-500">*</span></label>
                                <select wire:model.live="selectedProvince" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 p-2 border">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach($provinces as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedProvince') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Dropdown Kabupaten -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kabupaten / Kota <span class="text-red-500">*</span></label>
                                <select wire:model.live="selectedCity" {{ empty($cities) ? 'disabled' : '' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 p-2 border {{ empty($cities) ? 'bg-gray-100 cursor-not-allowed' : '' }}">
                                    <option value="">-- Pilih Kabupaten --</option>
                                    @foreach($cities as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedCity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Dropdown Kecamatan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                <select wire:model.live="selectedDistrict" {{ empty($districts) ? 'disabled' : '' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 p-2 border {{ empty($districts) ? 'bg-gray-100 cursor-not-allowed' : '' }}">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach($districts as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown Desa -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Desa / Kelurahan</label>
                                <select wire:model="selectedVillage" {{ empty($villages) ? 'disabled' : '' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 p-2 border {{ empty($villages) ? 'bg-gray-100 cursor-not-allowed' : '' }}">
                                    <option value="">-- Pilih Desa --</option>
                                    @foreach($villages as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pedesaan / Perkotaan -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Apakah tempat tinggal anda saat ini termasuk wilayah pedesaan ataukah perkotaan? <span class="text-red-500">*</span></label>
                                <select wire:model="tipe_tempat_tinggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 p-2 border">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Pedesaan">Pedesaan (jika desa)</option>
                                    <option value="Perkotaan">Perkotaan (jika kelurahan)</option>
                                </select>
                                @error('tipe_tempat_tinggal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BAGIAN 2: PENDIDIKAN -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-4 text-indigo-600 border-b pb-2">Bagian 2: Identifikasi Pendidikan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Pendidikan Tertinggi <span class="text-red-500">*</span></label>
                        <select wire:model.live="pendidikan_tertinggi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border">
                            <option value="">-- Pilih --</option>
                            <option value="SMA/Sederajat">SMA/Sederajat</option>
                            <option value="Diploma 1">Diploma 1</option>
                            <option value="Diploma 2">Diploma 2</option>
                            <option value="Diploma 3">Diploma 3</option>
                            <option value="Diploma 4">Diploma 4</option>
                            <option value="Sarjana (S1)">Sarjana (S1)</option>
                            <option value="Pendidikan Profesi">Pendidikan Profesi</option>
                            <option value="Magister (S2)">Magister (S2)</option>
                            <option value="Doktoral (S3)">Doktoral (S3)</option>
                        </select>
                        @error('pendidikan_tertinggi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if($pendidikan_tertinggi === 'SMA/Sederajat')
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                            <input type="text" wire:model="nama_sekolah" class="mt-1 block w-full rounded-md border p-2">
                        </div>
                    @elseif($pendidikan_tertinggi)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Perguruan Tinggi</label>
                            <input type="text" wire:model="perguruan_tinggi" class="mt-1 block w-full rounded-md border p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <input type="text" wire:model="program_studi" class="mt-1 block w-full rounded-md border p-2">
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun Lulus</label>
                        <input type="number" wire:model="tahun_lulus" min="2015" max="2026" class="mt-1 block w-full rounded-md border p-2" placeholder="2022">
                    </div>
                </div>
            </div>

            <!-- BAGIAN 3: SERTIFIKASI -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-4 text-indigo-600 border-b pb-2">Bagian 3: Sertifikasi Kompetensi</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apakah anda pernah mengikuti sertifikasi kompetensi di Lembaga Sertifikasi Profesi (LSP)? <span class="text-red-500">*</span></label>
                        <select wire:model.live="pernah_sertifikasi_lsp" class="mt-1 block w-full rounded-md border p-2">
                            <option value="">-- Pilih --</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        @error('pernah_sertifikasi_lsp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if($pernah_sertifikasi_lsp === 'Ya')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Apakah anda berhasil mendapatkan sertifikat kompetensi dari BNSP?</label>
                            <select wire:model="dapat_sertifikat_bnsp" class="mt-1 block w-full rounded-md border p-2">
                                <option value="">-- Pilih --</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skema sertifikasi kompetensi apa yang saat itu anda ikuti?</label>
                            <input type="text" wire:model="skema_sertifikasi" class="mt-1 block w-full rounded-md border p-2" placeholder="Tuliskan nama skema...">
                        </div>
                    @endif
                </div>
            </div>

            <!-- BAGIAN 4: PEKERJAAN -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-4 text-indigo-600 border-b pb-2">Bagian 4: Identifikasi Pekerjaan</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dalam seminggu terakhir, apakah anda bekerja atau melakukan kegiatan untuk menghasilkan pendapatan/uang? <span class="text-red-500">*</span></label>
                        <select wire:model.live="bekerja_seminggu_terakhir" class="mt-1 block w-full rounded-md border p-2">
                            <option value="">-- Pilih --</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        @error('bekerja_seminggu_terakhir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if($bekerja_seminggu_terakhir === 'Tidak')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Apakah sebenarnya anda sudah memiliki pekerjaan namun sedang tidak bekerja dalam 1 minggu terakhir?</label>
                            <select wire:model.live="punya_pekerjaan_tapi_tidak_bekerja" class="mt-1 block w-full rounded-md border p-2">
                                <option value="">-- Pilih --</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        
                        @if($punya_pekerjaan_tapi_tidak_bekerja === 'Tidak')
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mengapa saat ini anda tidak sedang bekerja?</label>
                                <select wire:model="alasan_tidak_bekerja" class="mt-1 block w-full rounded-md border p-2">
                                    <option value="">-- Pilih Alasan --</option>
                                    <option value="Masih sedang mencari pekerjaan">Masih sedang mencari pekerjaan</option>
                                    <option value="Sedang studi lanjut">Sedang studi lanjut</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        @endif
                    @endif

                    @if($bekerja_seminggu_terakhir === 'Ya' || $punya_pekerjaan_tapi_tidak_bekerja === 'Ya')
                        <hr class="my-4">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status Pekerjaan Anda</label>
                                <select wire:model="status_pekerjaan" class="mt-1 block w-full rounded-md border p-2">
                                    <option value="">-- Pilih --</option>
                                    <option value="Self-employed">Self-employed</option>
                                    <option value="Laborer/employee/staff">Laborer/employee/staff</option>
                                    <option value="Freelance worker">Freelance worker</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Gaji/Pendapatan Bersih (Bulanan)</label>
                                <input type="number" wire:model="gaji_bulanan" class="mt-1 block w-full rounded-md border p-2" placeholder="Contoh: 12000000">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tahun Mulai Bekerja</label>
                                <input type="number" wire:model="tahun_mulai_bekerja" class="mt-1 block w-full rounded-md border p-2" placeholder="Contoh: 2021">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Jam Kerja Seminggu (Maks 84)</label>
                                <input type="number" wire:model="jumlah_jam_kerja" max="84" class="mt-1 block w-full rounded-md border p-2" placeholder="Contoh: 40">
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Jenis Pekerjaan/Jabatan (ISCO 2/3 Digit)</label>
                                <input type="text" wire:model="jenis_pekerjaan" class="mt-1 block w-full rounded-md border p-2" placeholder="Tuliskan nama jabatan...">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Kirim Kuisioner
            </button>
        </form>
    @endif
</div>

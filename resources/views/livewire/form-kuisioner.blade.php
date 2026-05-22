<div class="max-w-4xl mx-auto p-4 md:p-8 mt-10">
    <!-- HEADER APP -->
    <div class="bg-gradient-to-r from-indigo-600 to-violet-700 rounded-2xl shadow-xl p-6 md:p-8 text-white mb-8 text-center md:text-left relative overflow-hidden">
        <div class="absolute right-0 top-0 opacity-10 translate-x-12 -translate-y-12 transform scale-150">
            <svg width="400" height="400" viewBox="0 0 100 100" fill="currentColor">
                <circle cx="50" cy="50" r="40"/>
            </svg>
        </div>
        <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight">Tracer Study & Kuesioner Kompetensi</h2>
        <p class="mt-2 text-indigo-100 max-w-2xl text-sm md:text-base">Membantu peningkatan mutu pendidikan profesi, keselarasan kurikulum, dan evaluasi dampak sertifikat kompetensi BNSP.</p>
    </div>

    @if($isSubmitted)
        <!-- ANIMATED SUCCESS CARD -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 text-center max-w-lg mx-auto transform transition duration-500 ease-out scale-100">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-50 rounded-full mb-6">
                <svg class="w-10 h-10 text-green-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Terima Kasih Banyak!</h3>
            <p class="text-gray-600 text-sm mb-6 leading-relaxed">Data kuisioner Anda berhasil disimpan ke dalam sistem kami. Kontribusi Anda sangat berharga bagi evaluasi kurikulum dan mutu profesi.</p>
            <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 text-left text-xs text-gray-500 mb-6 space-y-1">
                <div class="flex justify-between"><span class="font-medium text-gray-700">Nama:</span> <span>{{ $nama }}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-700">Email:</span> <span>{{ $email }}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-700">Status Pekerjaan:</span> <span>{{ $bekerja_seminggu_terakhir === 'Ya' ? 'Bekerja' : 'Tidak Bekerja' }}</span></div>
            </div>
            <button onclick="window.location.reload();" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium shadow-md transition duration-200 w-full">
                Isi Kuisioner Baru
            </button>
        </div>
    @else
        @if($currentStep === 0)
            <!-- INTRO LANDING CARD -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-10 space-y-8 transform transition duration-300 hover:shadow-2xl">
                <!-- Welcome Banner -->
                <div class="border-b border-gray-100 pb-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 tracking-wider uppercase mb-2">
                        Penelitian Akademik & Profesi
                    </span>
                    <h3 class="text-xl md:text-3xl font-extrabold text-gray-800 leading-tight">
                        Kuesioner Tracer Study & Evaluasi Sertifikasi Kompetensi
                    </h3>
                </div>

                <!-- Intro Content with Justified Text alignment (Clean layout) -->
                <div class="text-gray-700 space-y-6 text-sm md:text-base leading-relaxed">
                    <p class="text-justify">
                        Terimakasih kepada Bapak/Ibu lulusan perguruan tinggi yang telah berkenan mengunjungi halaman pengisian kuesioner ini. Perkenalkan, saya <strong>Dani Rahman Hakim</strong>, Ketua tim peneliti dari <strong>Forum Lembaga Sertifikasi Profesi (LSP) Perguruan Tinggi Swasta (PTS) Indonesia</strong>.
                    </p>
                    <p class="text-justify">
                        Bapak/Ibu lulusan perguruan tinggi, sebagaimana yang kita ketahui bahwa persaingan di dunia kerja saat ini semakin kompetitif. Tidak sedikit lulusan perguruan tinggi yang kesulitan mendapatkan pekerjaan yang sesuai dengan level dan bidang pendidikannya. Salah satu upaya perguruan tinggi untuk membantu lulusannya menghadapi dunia kerja ini adalah dengan menerapkan kebijakan sertifikasi kompetensi (uji kompetensi).
                    </p>
                    <p class="text-justify">
                        Namun demikian, belum ditemukan penelitian mengenai apakah benar bahwa sertifikat kompetensi (yang diterbitkan BNSP) dapat berdampak positif bagi lulusan perguruan tinggi di Indonesia. Untuk itu, kami berupaya meneliti tentang bagaimana dampak sertifikasi kompetensi terhadap kesesuaian pekerjaan, kemudahan mendapatkan pekerjaan, jenjang karir, serta tingkat pendapatan lulusan perguruan tinggi.
                    </p>
                    <p class="text-justify">
                        Hasil dari penelitian ini diharapkan dapat memberikan masukan yang penting bagi kebijakan tentang sertifikasi nasional serta pengembangan sumber daya manusia Indonesia. Berdasarkan hal tersebut, kami memohon waktu dari Bapak/Ibu lulusan perguruan tinggi untuk mengisi kuesioner ini dengan sebenar-benarnya.
                    </p>
                    <div class="font-medium text-indigo-950 bg-indigo-50/50 p-5 rounded-xl border border-indigo-100/60 text-justify">
                        Seluruh hasil isian kuesioner ini akan digunakan hanya untuk tujuan penelitian. Kami menjamin keamanan dan kerahasiaan data Bapak/Ibu lulusan.
                    </div>

                    <!-- Researcher Sign-off Signature (Word document style) -->
                    <div class="flex justify-end pt-4">
                        <div class="text-right text-sm text-gray-700 w-full md:w-72">
                            <p class="italic">Hormat kami,</p>
                            <div class="h-16"></div> <!-- Space for signature -->
                            <p class="font-bold text-gray-900 border-b border-gray-200 pb-1">Dani Rahman Hakim</p>
                            <p class="text-xs text-gray-500">Ketua Tim Peneliti Forum LSP PTS</p>
                        </div>
                    </div>
                </div>

                <!-- Incentive Card / Reward Highlight (No Icons/Emojis) -->
                <div class="bg-gradient-to-r from-amber-500/10 to-orange-500/10 border border-amber-200/60 rounded-xl p-5 md:p-6 transition duration-200 hover:border-amber-300">
                    <div class="space-y-2">
                        <h4 class="font-bold text-amber-900 text-sm md:text-base flex items-center gap-1.5">
                            <span>Apresiasi Pengisian Kuesioner</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-200 text-amber-800 uppercase tracking-wide">Gopay Reward</span>
                        </h4>
                        <p class="text-xs md:text-sm text-amber-800 leading-relaxed text-justify">
                            Sebagai salah satu bentuk apresiasi, kami menyediakan hadiah sebesar <span class="font-bold text-amber-900 text-base">Rp. 500.000</span> berupa saldo Gopay untuk <span class="font-bold text-amber-900">4 pengisi kuesioner yang beruntung</span>.
                        </p>
                        <p class="text-xs text-amber-700 font-medium text-justify">
                            Pengumuman pemenang akan dilakukan melalui Instagram resmi Forum LSP P1 PTS Indonesia: <a href="https://instagram.com/forumlspptsi" target="_blank" rel="noopener" class="underline hover:text-orange-700 font-bold">@forumlspptsi</a>
                        </p>
                        <p class="text-[10px] text-amber-600 italic">
                            * Hati-hati penipuan! Kami tidak memungut biaya sepeser pun untuk pemenang maupun pengisi kuesioner ini.
                        </p>
                    </div>
                </div>

                <!-- Call to Action (No icons) -->
                <div class="pt-2 flex justify-center md:justify-end">
                    <button type="button" wire:click="nextStep" class="w-full md:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg transition duration-200 inline-flex items-center justify-center transform hover:-translate-y-0.5 active:translate-y-0 text-sm md:text-base ring-4 ring-indigo-50 hover:ring-indigo-100">
                        <span>Mulai Pengisian Kuesioner</span>
                    </button>
                </div>
            </div>
        @else
            <!-- MULTI-STEP PROGRESS STEPPER -->
        <div class="mb-8 px-2 md:px-6">
            <div class="flex items-center justify-between relative">
                <!-- Progress Line Background -->
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 -z-10 rounded-full"></div>
                <!-- Active Progress Line -->
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-indigo-500 -z-10 rounded-full transition-all duration-300 ease-out"
                     style="width: {{ (($currentStep - 1) / 3) * 100 }}%"></div>

                <!-- Step 1 Button -->
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 font-bold transition-all duration-300 shadow-sm
                        {{ $currentStep === 1 ? 'bg-indigo-600 text-white border-indigo-600 ring-4 ring-indigo-100' : '' }}
                        {{ $currentStep > 1 ? 'bg-green-500 text-white border-green-500' : '' }}
                        {{ $currentStep < 1 ? 'bg-white text-gray-400 border-gray-300' : '' }}
                    ">
                        @if($currentStep > 1)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            1
                        @endif
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep === 1 ? 'text-indigo-600' : 'text-gray-500' }} hidden md:block">Demografi</span>
                </div>

                <!-- Step 2 Button -->
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 font-bold transition-all duration-300 shadow-sm
                        {{ $currentStep === 2 ? 'bg-indigo-600 text-white border-indigo-600 ring-4 ring-indigo-100' : '' }}
                        {{ $currentStep > 2 ? 'bg-green-500 text-white border-green-500' : '' }}
                        {{ $currentStep < 2 ? 'bg-white text-gray-400 border-gray-300' : '' }}
                    ">
                        @if($currentStep > 2)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            2
                        @endif
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep === 2 ? 'text-indigo-600' : 'text-gray-500' }} hidden md:block">Pendidikan & Sertifikasi</span>
                </div>

                <!-- Step 3 Button -->
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 font-bold transition-all duration-300 shadow-sm
                        {{ $currentStep === 3 ? 'bg-indigo-600 text-white border-indigo-600 ring-4 ring-indigo-100' : '' }}
                        {{ $currentStep > 3 ? 'bg-green-500 text-white border-green-500' : '' }}
                        {{ $currentStep < 3 ? 'bg-white text-gray-400 border-gray-300' : '' }}
                    ">
                        @if($currentStep > 3)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            3
                        @endif
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep === 3 ? 'text-indigo-600' : 'text-gray-500' }} hidden md:block">Pekerjaan</span>
                </div>

                <!-- Step 4 Button -->
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 font-bold transition-all duration-300 shadow-sm
                        {{ $currentStep === 4 ? 'bg-indigo-600 text-white border-indigo-600 ring-4 ring-indigo-100' : '' }}
                        {{ $currentStep < 4 ? 'bg-white text-gray-400 border-gray-300' : '' }}
                    ">
                        4
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep === 4 ? 'text-indigo-600' : 'text-gray-500' }} hidden md:block">Evaluasi & Dampak</span>
                </div>
            </div>
        </div>

        <form wire:submit.prevent="submit" class="space-y-6">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-xl text-sm flex items-start space-x-2.5">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div>
                        <strong class="font-bold">Mohon maaf, terdapat beberapa kesalahan pengisian:</strong>
                        <ul class="list-disc pl-4 mt-1 space-y-0.5 text-xs text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- STEP 1: DEMOGRAFI -->
            @if($currentStep === 1)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-xl font-bold text-gray-800">Bagian 1: Identifikasi Demografi</h3>
                        <p class="text-gray-500 text-xs mt-1">Isilah informasi identitas dan wilayah tempat tinggal Anda saat ini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" wire:model.blur="email" class="w-full rounded-xl @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="nama@email.com">
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-400 mt-1">Satu alamat email hanya dapat digunakan untuk melakukan satu kali pengisian kuesioner.</p>
                        </div>

                        <!-- Nama -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.blur="nama" class="w-full rounded-xl @error('nama') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Tuliskan nama lengkap sesuai identitas...">
                            @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select wire:model="jenis_kelamin" class="w-full rounded-xl @error('jenis_kelamin') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Usia -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Usia (Tahun) <span class="text-red-500">*</span></label>
                            <input type="number" wire:model="usia" min="15" max="70" class="w-full rounded-xl @error('usia') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="15 - 70 tahun">
                            @error('usia') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status Pernikahan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Status Pernikahan <span class="text-red-500">*</span></label>
                            <select wire:model.live="status_pernikahan" class="w-full rounded-xl @error('status_pernikahan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                <option value="">-- Pilih Status --</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Bercerai">Bercerai</option>
                            </select>
                            @error('status_pernikahan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Punya Anak -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Apakah Anda telah memiliki anak? <span class="text-red-500">*</span></label>
                            <select wire:model.live="punya_anak" class="w-full rounded-xl @error('punya_anak') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                <option value="">-- Pilih --</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                            @error('punya_anak') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Jumlah Anak -->
                        <div class="md:col-span-2 shadow-none" wire:key="group-jumlah-anak-container">
                            @if($punya_anak === 'Ya')
                                <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 transition-all duration-300">
                                    <label class="block text-sm font-semibold text-indigo-900 mb-1">Berapa jumlah anak Anda? <span class="text-red-500">*</span></label>
                                    <input type="number" wire:model.live="jumlah_anak" min="1" class="w-full md:w-1/2 rounded-xl @error('jumlah_anak') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150" placeholder="Masukkan jumlah anak (angka)">
                                    @error('jumlah_anak') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>

                        <!-- Wilayah Tempat Tinggal Section -->
                        <div class="md:col-span-2 pt-4 border-t border-gray-100">
                            <h4 class="font-bold text-gray-800 text-sm mb-3">Wilayah Tempat Tinggal Saat Ini</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Provinsi -->
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 mb-1">Provinsi <span class="text-red-500">*</span></label>
                                    <select wire:model.live="selectedProvince" class="w-full rounded-xl @error('selectedProvince') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih Provinsi --</option>
                                        @foreach($provinces as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedProvince') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Kabupaten -->
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kabupaten / Kota <span class="text-red-500">*</span></label>
                                    <select wire:model.live="selectedCity" {{ empty($cities) ? 'disabled' : '' }} class="w-full rounded-xl @error('selectedCity') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150 {{ empty($cities) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                        <option value="">-- Pilih Kabupaten/Kota --</option>
                                        @foreach($cities as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedCity') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Kecamatan -->
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kecamatan</label>
                                    <select wire:model.live="selectedDistrict" {{ empty($districts) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border bg-white transition duration-150 {{ empty($districts) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                        <option value="">-- Pilih Kecamatan --</option>
                                        @foreach($districts as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Kelurahan/Desa -->
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kelurahan / Desa</label>
                                    <select wire:model="selectedVillage" {{ empty($villages) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border bg-white transition duration-150 {{ empty($villages) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                        <option value="">-- Pilih Kelurahan/Desa --</option>
                                        @foreach($villages as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tipe Tempat Tinggal -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Wilayah Tempat Tinggal <span class="text-red-500">*</span></label>
                                    <select wire:model="tipe_tempat_tinggal" class="w-full rounded-xl @error('tipe_tempat_tinggal') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Pedesaan">Pedesaan (jika desa)</option>
                                        <option value="Perkotaan">Perkotaan (jika kelurahan)</option>
                                    </select>
                                    @error('tipe_tempat_tinggal') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- STEP 2: PENDIDIKAN & SERTIFIKASI -->
            @if($currentStep === 2)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8 space-y-6"
                     x-data="{
                         pendidikan_tertinggi: @entangle('pendidikan_tertinggi'),
                         pernah_sertifikasi_lsp: @entangle('pernah_sertifikasi_lsp'),
                         dapat_sertifikat_bnsp: @entangle('dapat_sertifikat_bnsp'),
                         competency_scheme_id: @entangle('competency_scheme_id'),
                         campus_id: @entangle('campus_id')
                     }">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-xl font-bold text-gray-800">Bagian 2: Identifikasi Pendidikan & Sertifikasi</h3>
                        <p class="text-gray-500 text-xs mt-1">Berikan data mengenai latar belakang pendidikan formal dan sertifikasi profesi Anda.</p>
                    </div>

                    <div class="space-y-5">
                        <!-- Pendidikan Tertinggi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jenjang Pendidikan Terakhir <span class="text-red-500">*</span></label>
                            <select wire:model.live="pendidikan_tertinggi" class="w-full rounded-xl @error('pendidikan_tertinggi') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                <option value="">-- Pilih Pendidikan Terakhir --</option>
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
                            @error('pendidikan_tertinggi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Conditional: SMA/Sederajat -->
                        <div x-show="pendidikan_tertinggi === 'SMA/Sederajat'" x-cloak class="bg-gray-50 p-5 rounded-2xl border border-gray-100 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Sekolah <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="nama_sekolah" class="w-full rounded-xl @error('nama_sekolah') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Tuliskan nama SMA / SMK / Sederajat Anda...">
                                @error('nama_sekolah') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Conditional: Perguruan Tinggi -->
                        <div x-show="pendidikan_tertinggi && pendidikan_tertinggi !== 'SMA/Sederajat'" x-cloak class="bg-gray-50 p-5 rounded-2xl border border-gray-100 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Perguruan Tinggi (Searchable Select) -->
                                <div class="md:col-span-2" 
                                     x-data="{
                                         isOpen: false,
                                         search: '',
                                         campuses: {{ json_encode($campuses->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->toArray()) }},
                                         get filteredCampuses() {
                                             if (this.search.trim() === '') return this.campuses;
                                             const query = this.search.toLowerCase();
                                             return this.campuses.filter(c => c.name.toLowerCase().includes(query));
                                         },
                                         get selectedName() {
                                             const found = this.campuses.find(c => c.id == campus_id);
                                             return found ? found.name : '-- Pilih Perguruan Tinggi --';
                                         },
                                         select(id) {
                                             campus_id = id;
                                             this.isOpen = false;
                                             this.search = '';
                                         }
                                     }"
                                     @click.away="isOpen = false"
                                     class="relative">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Perguruan Tinggi <span class="text-red-500">*</span></label>
                                    
                                    <!-- Trigger button -->
                                    <button type="button" 
                                            @click="isOpen = !isOpen; if (isOpen) { $nextTick(() => $refs.searchInput.focus()) }"
                                            class="w-full text-left rounded-xl border @error('campus_id') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 @enderror shadow-sm bg-white p-2.5 transition duration-150 focus:outline-none flex justify-between items-center text-sm">
                                        <span x-text="selectedName" :class="campus_id ? 'text-gray-900' : 'text-gray-400'"></span>
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    
                                    <!-- Dropdown Menu -->
                                    <div x-show="isOpen" 
                                         x-cloak 
                                         class="absolute z-30 mt-1 w-full bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden transform origin-top transition-all"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95">
                                        
                                        <!-- Search input inside dropdown -->
                                        <div class="p-2 border-b border-gray-100 bg-gray-50">
                                            <input type="text" 
                                                   x-ref="searchInput"
                                                   x-model="search" 
                                                   @keydown.escape="isOpen = false"
                                                   placeholder="Cari perguruan tinggi..." 
                                                   class="w-full text-xs rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                                        </div>
                                        
                                        <!-- Scrollable option list -->
                                        <ul class="max-h-60 overflow-y-auto divide-y divide-gray-50 text-sm">
                                            <li @click="select(null)" 
                                                class="p-2.5 hover:bg-indigo-50 cursor-pointer text-gray-500 font-medium transition duration-150">
                                                -- Pilih Perguruan Tinggi --
                                            </li>
                                            <template x-for="campus in filteredCampuses" :key="campus.id">
                                                <li @click="select(campus.id)" 
                                                    :class="campus_id == campus.id ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-700 hover:bg-indigo-50/50'"
                                                    class="p-2.5 cursor-pointer transition duration-150"
                                                    x-text="campus.name">
                                                </li>
                                            </template>
                                            <template x-if="filteredCampuses.length === 0">
                                                <li class="p-4 text-xs text-center text-gray-500 italic">
                                                    Perguruan tinggi tidak ditemukan.
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    
                                    @error('campus_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Program Studi -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Program Studi <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="program_studi" class="w-full rounded-xl @error('program_studi') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Tuliskan nama Program Studi...">
                                    @error('program_studi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Tahun Lulus -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Lulus (2015 - 2026) <span class="text-red-500">*</span></label>
                                    <input type="number" wire:model="tahun_lulus" min="2015" max="2026" class="w-full rounded-xl @error('tahun_lulus') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Contoh: 2022">
                                    @error('tahun_lulus') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- IPK -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">IPK Terakhir (2.50 - 4.00) <span class="text-red-500">*</span></label>
                                    <input type="number" step="0.01" min="2.50" max="4.00" wire:model="ipk" class="w-full rounded-xl @error('ipk') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Contoh: 3.45">
                                    @error('ipk') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Melanjutkan Pendidikan -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Melanjutkan Studi Lanjut? <span class="text-red-500">*</span></label>
                                    <select wire:model="melanjutkan_pendidikan" class="w-full rounded-xl @error('melanjutkan_pendidikan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih --</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                    @error('melanjutkan_pendidikan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sertifikasi Profesi LSP -->
                        <div class="pt-4 border-t border-gray-100 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Apakah Anda pernah mengikuti sertifikasi kompetensi di Lembaga Sertifikasi Profesi (LSP)? <span class="text-red-500">*</span></label>
                                <select wire:model.live="pernah_sertifikasi_lsp" class="w-full rounded-xl @error('pernah_sertifikasi_lsp') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                    <option value="">-- Pilih --</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                                @error('pernah_sertifikasi_lsp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div x-show="pernah_sertifikasi_lsp === 'Ya'" x-cloak class="bg-indigo-50/50 p-5 rounded-2xl border border-indigo-100 space-y-4 transition-all duration-300">
                                <!-- Dapat Sertifikat BNSP -->
                                <div>
                                    <label class="block text-sm font-semibold text-indigo-900 mb-1">Apakah Anda berhasil mendapatkan sertifikat kompetensi dari BNSP? <span class="text-red-500">*</span></label>
                                    <select wire:model.live="dapat_sertifikat_bnsp" class="w-full rounded-xl @error('dapat_sertifikat_bnsp') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih --</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                    @error('dapat_sertifikat_bnsp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Skema Sertifikat (Hanya jika berhasil) -->
                                <div x-show="dapat_sertifikat_bnsp === 'Ya'" x-cloak>
                                    <label class="block text-sm font-semibold text-indigo-900 mb-1">Skema sertifikasi kompetensi apa yang saat itu Anda ikuti? <span class="text-red-500">*</span></label>
                                    @if($campus_id)
                                        <select wire:model.live="competency_scheme_id" class="w-full rounded-xl @error('competency_scheme_id') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150 mb-3">
                                            <option value="">-- Pilih Skema Sertifikasi --</option>
                                            @foreach($competencySchemes as $scheme)
                                                <option value="{{ $scheme->id }}">{{ $scheme->name }}</option>
                                            @endforeach
                                            <option value="other">-- Skema Lainnya (Tulis Manual) --</option>
                                        </select>
                                    @else
                                        <div class="text-xs text-amber-700 bg-amber-50 p-3 rounded-lg border border-amber-200 mb-3">
                                            Info: Mohon pilih Perguruan Tinggi Anda terlebih dahulu untuk memunculkan daftar skema sertifikasi kompetensi. Anda dapat memilih "Skema Lainnya" jika universitas tidak memiliki data tercatat.
                                        </div>
                                        <select wire:model.live="competency_scheme_id" class="w-full rounded-xl @error('competency_scheme_id') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150 mb-3">
                                            <option value="">-- Pilih Skema --</option>
                                            <option value="other">-- Skema Lainnya (Tulis Manual) --</option>
                                        </select>
                                    @endif
                                    @error('competency_scheme_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                                    <!-- Manual Entry if "Lainnya" -->
                                    <div x-show="competency_scheme_id === 'other'" x-cloak class="mt-2.5">
                                        <label class="block text-xs font-semibold text-indigo-800 mb-1">Nama Skema Sertifikasi (Ketik manual) <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model="skema_sertifikasi_lainnya" class="w-full rounded-xl @error('skema_sertifikasi_lainnya') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Ketik nama skema sertifikasi lengkap...">
                                        @error('skema_sertifikasi_lainnya') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- STEP 3: PEKERJAAN -->
            @if($currentStep === 3)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-xl font-bold text-gray-800">Bagian 3: Identifikasi Pekerjaan</h3>
                        <p class="text-gray-500 text-xs mt-1">Isi data terkait pekerjaan utama saat ini, pekerjaan tambahan, atau status keaktifan Anda.</p>
                    </div>

                    <div class="space-y-6">
                        <!-- Pertanyaan Bekerja Seminggu Terakhir -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Dalam seminggu terakhir, apakah Anda bekerja atau melakukan kegiatan usaha untuk menghasilkan pendapatan/uang? <span class="text-red-500">*</span></label>
                            <select wire:model.live="bekerja_seminggu_terakhir" class="w-full rounded-xl @error('bekerja_seminggu_terakhir') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                <option value="">-- Pilih --</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                            @error('bekerja_seminggu_terakhir') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- CASE: TIDAK BEKERJA -->
                        @if($bekerja_seminggu_terakhir === 'Tidak')
                            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 space-y-5 transition-all duration-300">
                                <!-- Punya Pekerjaan Tapi Sedang Tidak Bekerja -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Apakah sebenarnya Anda sudah memiliki pekerjaan namun sedang tidak bekerja dalam seminggu terakhir? <span class="text-red-500">*</span></label>
                                    <select wire:model.live="punya_pekerjaan_tapi_tidak_bekerja" class="w-full rounded-xl @error('punya_pekerjaan_tapi_tidak_bekerja') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih --</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                    @error('punya_pekerjaan_tapi_tidak_bekerja') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                @if($punya_pekerjaan_tapi_tidak_bekerja === 'Tidak')
                                    <!-- Pernah bekerja sebelumnya -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Apakah sebelumnya Anda pernah bekerja / memiliki usaha? <span class="text-red-500">*</span></label>
                                        <select wire:model.live="pernah_bekerja_sebelumnya" class="w-full rounded-xl @error('pernah_bekerja_sebelumnya') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih --</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                        @error('pernah_bekerja_sebelumnya') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    @if($pernah_bekerja_sebelumnya === 'Ya')
                                        <!-- Previous Job ISCO Cascading Dropdowns -->
                                        <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 space-y-3">
                                            <label class="block text-sm font-semibold text-indigo-900">Apa jenis pekerjaan / jabatan Anda saat itu? <span class="text-red-500">*</span></label>
                                            
                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Kategori Utama (Level 1) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="prev_isco_l1" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2.5 border bg-white transition duration-150">
                                                    <option value="">-- Pilih Level 1 --</option>
                                                    @foreach($iscoL1Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Sub-Kategori (Level 2) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="prev_isco_l2" {{ empty($prevIscoL2Options) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2.5 border bg-white transition duration-150 {{ empty($prevIscoL2Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                    <option value="">-- Pilih Level 2 --</option>
                                                    @foreach($prevIscoL2Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Grup Utama (Level 3) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="prev_isco_l3" {{ empty($prevIscoL3Options) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2.5 border bg-white transition duration-150 {{ empty($prevIscoL3Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                    <option value="">-- Pilih Level 3 --</option>
                                                    @foreach($prevIscoL3Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Pekerjaan Spesifik (Level 4) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="prev_isco_l4" {{ empty($prevIscoL4Options) ? 'disabled' : '' }} class="w-full rounded-xl @error('pekerjaan_sebelumnya_isco_code') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150 {{ empty($prevIscoL4Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                    <option value="">-- Pilih Level 4 --</option>
                                                    @foreach($prevIscoL4Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pekerjaan_sebelumnya_isco_code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>

                                            @if($pekerjaan_sebelumnya_isco_title_id)
                                                <div class="text-xs bg-indigo-100 border border-indigo-200 text-indigo-900 rounded-lg p-2.5 font-medium">
                                                    Terpilih: {{ $pekerjaan_sebelumnya_isco_code }} - {{ $pekerjaan_sebelumnya_isco_title_id }} ({{ $pekerjaan_sebelumnya_isco_title_en }})
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Alasan tidak bekerja -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mengapa saat ini Anda tidak sedang bekerja? <span class="text-red-500">*</span></label>
                                        <select wire:model="alasan_tidak_bekerja" class="w-full rounded-xl @error('alasan_tidak_bekerja') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih Alasan --</option>
                                            <option value="Masih sedang mencari pekerjaan">Masih sedang mencari pekerjaan</option>
                                            <option value="Sedang menambah kompetensi (up-skilling)">Sedang menambah kompetensi (up-skilling)</option>
                                            <option value="Sedang studi lanjut / tugas belajar">Sedang studi lanjut / tugas belajar</option>
                                            <option value="Sedang mengikuti pemagangan">Sedang mengikuti pemagangan</option>
                                            <option value="Sedang sakit (tidak mampu bekerja)">Sedang sakit (tidak mampu bekerja)</option>
                                            <option value="Lainnya">Lainnya / Mengurus Rumah Tangga</option>
                                        </select>
                                        @error('alasan_tidak_bekerja') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- CASE: BEKERJA (Ya atau Punya pekerjaan tapi libur) -->
                        @if($bekerja_seminggu_terakhir === 'Ya' || $punya_pekerjaan_tapi_tidak_bekerja === 'Ya')
                            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 space-y-5 transition-all duration-300">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Dimulai Setelah Lulus -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kapan pekerjaan ini didapatkan / dimulai? <span class="text-red-500">*</span></label>
                                        <select wire:model.live="pekerjaan_dimulai_setelah_lulus" class="w-full rounded-xl @error('pekerjaan_dimulai_setelah_lulus') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih --</option>
                                            <option value="Ya">Didapatkan / dimulai SETELAH lulus kuliah</option>
                                            <option value="Telah Bekerja Sebelum Lulus">Telah bekerja SEBELUM lulus kuliah</option>
                                        </select>
                                        @error('pekerjaan_dimulai_setelah_lulus') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Waktu Tunggu Kerja -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Berapa bulan waktu yang diperlukan setelah lulus untuk mendapat pekerjaan ini? <span class="text-red-500">*</span></label>
                                        <input type="number" wire:model="waktu_tunggu_kerja" min="0" max="60" class="w-full rounded-xl @error('waktu_tunggu_kerja') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150" placeholder="0 - 60 bulan">
                                        @error('waktu_tunggu_kerja') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        <p class="text-xs text-gray-400 mt-1">Masukkan 0 jika langsung bekerja saat lulus.</p>
                                    </div>

                                    <!-- Status Pekerjaan -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status Pekerjaan Utama <span class="text-red-500">*</span></label>
                                        <select wire:model="status_pekerjaan" class="w-full rounded-xl @error('status_pekerjaan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Berusaha sendiri/wiraswasta">Berusaha sendiri/wiraswasta</option>
                                            <option value="Berwirausaha dengan dibantu oleh tenaga kerja tetap">Berwirausaha dengan dibantu oleh tenaga kerja tetap</option>
                                            <option value="Berwirausaha dengan dibantu oleh tenaga kerja tidak tetap">Berwirausaha dengan dibantu oleh tenaga kerja tidak tetap</option>
                                            <option value="Karyawan/pegawai/buruh">Karyawan/pegawai/buruh</option>
                                            <option value="Pekerja lepas pertanian">Pekerja lepas pertanian</option>
                                            <option value="Pekerja lepas non-pertanian">Pekerja lepas non-pertanian</option>
                                            <option value="Pekerja keluarga tidak dibayar">Pekerja keluarga tidak dibayar</option>
                                        </select>
                                        @error('status_pekerjaan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Gaji Bulanan -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Gaji / Pendapatan Bersih Bulanan (Rp) <span class="text-red-500">*</span></label>
                                        <input type="number" wire:model.live="gaji_bulanan" class="w-full rounded-xl @error('gaji_bulanan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Contoh: 7500000">
                                        @error('gaji_bulanan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Spelled Out Salary Display Callout Box -->
                                    @if($gaji_terbilang)
                                        <div class="md:col-span-2 bg-indigo-50/50 border border-indigo-100 rounded-xl p-3.5 text-indigo-900 text-sm font-semibold transition-all duration-300 flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-6 4h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <span>Terbilang: <span class="text-indigo-700 font-bold italic">{{ $gaji_terbilang }}</span></span>
                                        </div>
                                    @endif

                                    <!-- Perbandingan UMR -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Perbandingan Gaji dengan UMR Setempat <span class="text-red-500">*</span></label>
                                        <select wire:model="gaji_perbandingan_umr" class="w-full rounded-xl @error('gaji_perbandingan_umr') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih Perbandingan --</option>
                                            <option value="Di bawah UMR">Di bawah UMR</option>
                                            <option value="Sebesar (sama atau mirip) dengan UMR">Sebesar (sama atau mirip) dengan UMR</option>
                                            <option value="Lebih besar dari UMR">Lebih besar dari UMR</option>
                                        </select>
                                        @error('gaji_perbandingan_umr') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Tahun Mulai Bekerja -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Mulai Bekerja di Tempat Ini <span class="text-red-500">*</span></label>
                                        <input type="number" wire:model="tahun_mulai_bekerja" class="w-full rounded-xl @error('tahun_mulai_bekerja') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Contoh: 2023">
                                        @error('tahun_mulai_bekerja') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- ISCO Cascading Dropdowns (Current Job) -->
                                    <div class="md:col-span-2 bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 space-y-3">
                                        <label class="block text-sm font-semibold text-indigo-900">Klasifikasi Jabatan Pekerjaan Utama Anda (ISCO-08) <span class="text-red-500">*</span></label>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Kategori Utama (Level 1) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="isco_l1" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2 border bg-white text-xs">
                                                    <option value="">-- Pilih Level 1 --</option>
                                                    @foreach($iscoL1Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Sub-Kategori (Level 2) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="isco_l2" {{ empty($iscoL2Options) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2 border bg-white text-xs {{ empty($iscoL2Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                    <option value="">-- Pilih Level 2 --</option>
                                                    @foreach($iscoL2Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Grup Utama (Level 3) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="isco_l3" {{ empty($iscoL3Options) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2 border bg-white text-xs {{ empty($iscoL3Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                    <option value="">-- Pilih Level 3 --</option>
                                                    @foreach($iscoL3Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Pekerjaan Spesifik (Level 4) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="isco_l4" {{ empty($iscoL4Options) ? 'disabled' : '' }} class="w-full rounded-xl @error('isco_code') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 @enderror shadow-sm p-2 border bg-white text-xs {{ empty($iscoL4Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                    <option value="">-- Pilih Level 4 --</option>
                                                    @foreach($iscoL4Options as $isco)
                                                        <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                    @endforeach
                                                </select>
                                                @error('isco_code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        @if($isco_title_id)
                                            <div class="text-xs bg-indigo-100 border border-indigo-200 text-indigo-900 rounded-lg p-2.5 font-medium">
                                                Terpilih: {{ $isco_code }} - {{ $isco_title_id }} ({{ $isco_title_en }})
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Jam Kerja & Lembur -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Jam Kerja Seminggu <span class="text-red-500">*</span></label>
                                        <input type="number" wire:model.live="jumlah_jam_kerja" min="1" max="84" class="w-full rounded-xl @error('jumlah_jam_kerja') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="1 - 84 jam">
                                        @error('jumlah_jam_kerja') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        <p class="text-xs text-gray-400 mt-1">Maksimal 84 jam per minggu.</p>
                                    </div>

                                    @if((int)$this->jumlah_jam_kerja > 40)
                                        <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 flex flex-col justify-center">
                                            <label class="block text-sm font-semibold text-indigo-900 mb-1">Jam kerja melebihi 40 jam. Apakah kelebihan jam tersebut dihitung lembur & dibayar? <span class="text-red-500">*</span></label>
                                            <select wire:model="ada_lembur" class="w-full rounded-xl @error('ada_lembur') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                                <option value="">-- Pilih --</option>
                                                <option value="Ya">Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                            @error('ada_lembur') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>
                                    @endif

                                    <!-- Perusahaan Details -->
                                    <div class="md:col-span-2 pt-3 border-t border-gray-200">
                                        <h4 class="font-bold text-gray-800 text-sm mb-3">Identitas Perusahaan / Pemberi Kerja</h4>
                                    </div>

                                    <!-- Nama Perusahaan -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Perusahaan / Instansi / Lembaga <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model="nama_perusahaan" class="w-full rounded-xl @error('nama_perusahaan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="Ketik nama instansi tempat bekerja...">
                                        @error('nama_perusahaan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Jenis Perusahaan -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Perusahaan / Instansi <span class="text-red-500">*</span></label>
                                        <select wire:model="jenis_perusahaan" class="w-full rounded-xl @error('jenis_perusahaan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih Jenis --</option>
                                            <option value="Perusahaan/institusi berorientasi profit (PT, CV, UD, BUMN, BUMD)">Perusahaan berorientasi profit (PT, CV, UD, BUMN, BUMD)</option>
                                            <option value="Institusi/organisasi pemerintah">Institusi/organisasi pemerintah (Kementerian, Dinas, dll)</option>
                                            <option value="Organisasi/institusi nirlaba atau institusi internasional">Organisasi nirlaba / Institusi Internasional / Yayasan</option>
                                            <option value="Wirausahawan/perusahaan sendiri/usaha rumahan">Wirausahawan / Usaha Rumahan Sendiri</option>
                                        </select>
                                        @error('jenis_perusahaan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Jumlah Karyawan -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Karyawan / Tenaga Kerja <span class="text-red-500">*</span></label>
                                        <select wire:model="jumlah_karyawan" class="w-full rounded-xl @error('jumlah_karyawan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih Rentang --</option>
                                            <option value="1 s.d 4 karyawan (usaha mikro/usaha rumahan)">1 s.d 4 karyawan (Usaha Mikro)</option>
                                            <option value="5 s.d 19 karyawan (usaha kecil)">5 s.d 19 karyawan (Usaha Kecil)</option>
                                            <option value="20 s.d 99 karyawan (usaha menengah)">20 s.d 99 karyawan (Usaha Menengah)</option>
                                            <option value="lebih dari 100 karyawan (usaha besar)">Lebih dari 100 karyawan (Usaha Besar)</option>
                                        </select>
                                        @error('jumlah_karyawan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- ISIC Cascading Dropdowns (Bidang Usaha Perusahaan) -->
                                    <div class="md:col-span-2 bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 space-y-3">
                                        <label class="block text-sm font-semibold text-indigo-900">Bidang Usaha Perusahaan (Klasifikasi ISIC) <span class="text-red-500">*</span></label>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">Sektor Kategori (ISIC Level 1) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="selectedIsicSector" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2 border bg-white text-xs">
                                                    <option value="">-- Pilih Sektor --</option>
                                                    @foreach($isicSectors as $sector)
                                                        <option value="{{ $sector->code }}">{{ $sector->code }} - {{ $sector->title_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-semibold text-indigo-800 mb-1">Divisi Sub-Kategori (ISIC Level 2) <span class="text-red-500">*</span></label>
                                                <select wire:model.live="isic_code" {{ empty($isicDivisions) ? 'disabled' : '' }} class="w-full rounded-xl @error('isic_code') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 @enderror shadow-sm p-2 border bg-white text-xs {{ empty($isicDivisions) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                    <option value="">-- Pilih Divisi --</option>
                                                    @foreach($isicDivisions as $division)
                                                        <option value="{{ $division->code }}">{{ $division->code }} - {{ $division->title_id }}</option>
                                                    @endforeach
                                                </select>
                                                @error('isic_code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        @if($isic_title_id)
                                            <div class="text-xs bg-indigo-100 border border-indigo-200 text-indigo-900 rounded-lg p-2.5 font-medium">
                                                Terpilih: {{ $isic_code }} - {{ $isic_title_id }} ({{ $isic_title_en }})
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Pekerjaan Tambahan Section -->
                                    <div class="md:col-span-2 pt-4 border-t border-gray-200">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Di luar pekerjaan utama, apakah saat ini Anda memiliki pekerjaan atau usaha lain (sampingan/tambahan)? <span class="text-red-500">*</span></label>
                                        <select wire:model.live="punya_pekerjaan_tambahan" class="w-full rounded-xl @error('punya_pekerjaan_tambahan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih --</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                        @error('punya_pekerjaan_tambahan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Conditional Pekerjaan Sampingan -->
                                    @if($punya_pekerjaan_tambahan === 'Ya')
                                        <div class="md:col-span-2 bg-indigo-50/50 p-4 rounded-xl border border-indigo-100 space-y-4">
                                            <h5 class="font-bold text-indigo-900 text-xs tracking-wider uppercase border-b border-indigo-200 pb-1.5">Rincian Pekerjaan Tambahan / Sampingan</h5>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <!-- Status Pekerjaan Sampingan -->
                                                <div>
                                                    <label class="block text-xs font-semibold text-indigo-800 mb-1">Status Pekerjaan Tambahan <span class="text-red-500">*</span></label>
                                                    <select wire:model="status_pekerjaan_tambahan" class="w-full rounded-xl @error('status_pekerjaan_tambahan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Berusaha sendiri/wiraswasta">Berusaha sendiri/wiraswasta</option>
                                                        <option value="Berwirausaha dengan dibantu oleh tenaga kerja tetap">Berwirausaha dengan dibantu oleh tenaga kerja tetap</option>
                                                        <option value="Berwirausaha dengan dibantu oleh tenaga kerja tidak tetap">Berwirausaha dengan dibantu oleh tenaga kerja tidak tetap</option>
                                                        <option value="Karyawan/pegawai/buruh">Karyawan/pegawai/buruh</option>
                                                        <option value="Pekerja lepas pertanian">Pekerja lepas pertanian</option>
                                                        <option value="Pekerja lepas non-pertanian">Pekerja lepas non-pertanian</option>
                                                        <option value="Pekerja keluarga tidak dibayar">Pekerja keluarga tidak dibayar</option>
                                                    </select>
                                                    @error('status_pekerjaan_tambahan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                                </div>

                                                <!-- Jam Kerja Sampingan -->
                                                <div>
                                                    <label class="block text-xs font-semibold text-indigo-800 mb-1">Jumlah Jam Kerja Sampingan Seminggu <span class="text-red-500">*</span></label>
                                                    <input type="number" wire:model="jumlah_jam_kerja_tambahan" min="1" max="84" class="w-full rounded-xl @error('jumlah_jam_kerja_tambahan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 @enderror shadow-sm p-2.5 border transition duration-150" placeholder="1 - 84 jam">
                                                    @error('jumlah_jam_kerja_tambahan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                                </div>

                                                <!-- ISCO Sampingan Cascading Dropdowns -->
                                                <div class="md:col-span-2 space-y-3">
                                                    <label class="block text-xs font-semibold text-indigo-900">Klasifikasi Jabatan Pekerjaan Tambahan (ISCO-08) <span class="text-red-500">*</span></label>
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                        <div>
                                                            <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Kategori Utama (Level 1) <span class="text-red-500">*</span></label>
                                                            <select wire:model.live="pekerjaan_tambahan_isco_l1" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2 border bg-white text-xs">
                                                                <option value="">-- Pilih Level 1 --</option>
                                                                @foreach($iscoL1Options as $isco)
                                                                    <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Sub-Kategori (Level 2) <span class="text-red-500">*</span></label>
                                                            <select wire:model.live="pekerjaan_tambahan_isco_l2" {{ empty($addIscoL2Options) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2 border bg-white text-xs {{ empty($addIscoL2Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                                <option value="">-- Pilih Level 2 --</option>
                                                                @foreach($addIscoL2Options as $isco)
                                                                    <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Grup Utama (Level 3) <span class="text-red-500">*</span></label>
                                                            <select wire:model.live="pekerjaan_tambahan_isco_l3" {{ empty($addIscoL3Options) ? 'disabled' : '' }} class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 p-2 border bg-white text-xs {{ empty($addIscoL3Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                                <option value="">-- Pilih Level 3 --</option>
                                                                @foreach($addIscoL3Options as $isco)
                                                                    <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label class="block text-xs font-semibold text-indigo-800 mb-1">ISCO Pekerjaan Spesifik (Level 4) <span class="text-red-500">*</span></label>
                                                            <select wire:model.live="pekerjaan_tambahan_isco_l4" {{ empty($addIscoL4Options) ? 'disabled' : '' }} class="w-full rounded-xl @error('pekerjaan_tambahan_isco_code') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 @enderror shadow-sm p-2 border bg-white text-xs {{ empty($addIscoL4Options) ? 'bg-gray-50 opacity-60 cursor-not-allowed' : '' }}">
                                                                <option value="">-- Pilih Level 4 --</option>
                                                                @foreach($addIscoL4Options as $isco)
                                                                    <option value="{{ $isco->code }}">{{ $isco->code }} - {{ $isco->title_id }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('pekerjaan_tambahan_isco_code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>

                                                    @if($pekerjaan_tambahan_isco_title_id)
                                                        <div class="text-xs bg-indigo-100 border border-indigo-200 text-indigo-900 rounded-lg p-2.5 font-medium">
                                                            Terpilih Sampingan: {{ $pekerjaan_tambahan_isco_code }} - {{ $pekerjaan_tambahan_isco_title_id }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Pernah bekerja di tempat lain sebelum saat ini -->
                                    <div class="md:col-span-2 pt-3 border-t border-gray-200">
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sebelum menduduki pekerjaan saat ini, apakah sebelumnya Anda pernah bekerja di tempat lain? <span class="text-red-500">*</span></label>
                                        <select wire:model="pernah_bekerja_sebelumnya_lain" class="w-full rounded-xl @error('pernah_bekerja_sebelumnya_lain') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror shadow-sm p-2.5 border bg-white transition duration-150">
                                            <option value="">-- Pilih --</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                        @error('pernah_bekerja_sebelumnya_lain') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- STEP 4: EVALUASI & DAMPAK -->
            @if($currentStep === 4)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-3">
                        <h3 class="text-xl font-bold text-gray-800">Bagian 4: Evaluasi Tracer Study & Dampak Sertifikasi BNSP</h3>
                        <p class="text-gray-500 text-xs mt-1">Evaluasi keselarasan kurikulum dengan dunia kerja serta dampak pemilikan sertifikat kompetensi BNSP.</p>
                    </div>

                    @if($bekerja_seminggu_terakhir === 'Tidak' && $punya_pekerjaan_tapi_tidak_bekerja === 'Tidak')
                        <!-- Message if unemployed -->
                        <div class="bg-indigo-50 rounded-2xl border border-indigo-100 p-6 text-center text-indigo-950">
                            <svg class="w-12 h-12 text-indigo-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h4 class="font-bold text-lg mb-2">Pemberitahuan</h4>
                            <p class="text-sm leading-relaxed max-w-lg mx-auto">
                                Bagian evaluasi tracer study dan dampak sertifikasi ini ditujukan untuk responden yang sedang aktif bekerja atau memiliki usaha. Karena status Anda saat ini sedang tidak bekerja, silakan langsung mengirimkan kuisioner dengan menekan tombol **Kirim Kuisioner** di bawah ini.
                            </p>
                        </div>
                    @else
                        <!-- Questions if working -->
                        <div class="space-y-6">
                            <h4 class="font-bold text-gray-800 text-sm tracking-wider uppercase border-b pb-1">Kesesuaian Bidang & Pendidikan</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Kesesuaian Bidang Keahlian (Ijazah) -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Menurut Anda, apakah bidang pekerjaan Anda saat ini sudah sesuai dengan bidang keahlian Anda (keahlian sesuai ijazah pendidikan)? <span class="text-red-500">*</span></label>
                                    <select wire:model="kesesuaian_bidang_ijazah" class="w-full rounded-xl @error('kesesuaian_bidang_ijazah') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih Tingkat Kesesuaian --</option>
                                        <option value="Sangat Sesuai">1. Sangat Sesuai</option>
                                        <option value="Sesuai">2. Sesuai</option>
                                        <option value="Cukup Sesuai">3. Cukup Sesuai</option>
                                        <option value="Tidak Sesuai">4. Tidak Sesuai</option>
                                        <option value="Tidak Sesuai Sama Sekali">5. Tidak Sesuai Sama Sekali</option>
                                    </select>
                                    @error('kesesuaian_bidang_ijazah') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Kesesuaian Jenjang Pendidikan -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Apakah saat ini pekerjaan Anda sudah sesuai dengan jenjang pendidikan Anda? <span class="text-red-500">*</span></label>
                                    <select wire:model="kesesuaian_jenjang_pendidikan" class="w-full rounded-xl @error('kesesuaian_jenjang_pendidikan') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih --</option>
                                        <option value="Jenjang pendidikan saya terlalu rendah untuk pekerjaan ini (perlu pendidikan tambahan)">1. Jenjang pendidikan terlalu rendah (butuh pendidikan tambahan)</option>
                                        <option value="Jenjang pendidikan saya sudah sesuai dengan pekerjaan ini">2. Jenjang pendidikan sudah sesuai</option>
                                        <option value="Jenjang pendidikan saya terlalu tinggi untuk pekerjaan ini">3. Jenjang pendidikan terlalu tinggi</option>
                                    </select>
                                    @error('kesesuaian_jenjang_pendidikan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Jenjang Paling Sesuai -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Menurut Anda, jenjang pendidikan mana yang paling sesuai untuk pekerjaan Anda saat ini? <span class="text-red-500">*</span></label>
                                    <select wire:model="jenjang_paling_sesuai" class="w-full rounded-xl @error('jenjang_paling_sesuai') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                        <option value="">-- Pilih Jenjang --</option>
                                        <option value="Tidak memerlukan jenjang pendidikan">Tidak memerlukan jenjang pendidikan</option>
                                        <option value="Sekolah Dasar">Sekolah Dasar</option>
                                        <option value="Sekolah Menengah Pertama/Sederajat">Sekolah Menengah Pertama/Sederajat</option>
                                        <option value="Sekolah Menengah Atas/Sekolah Menengah Kejuruan/Sederajat">Sekolah Menengah Atas/SMK/Sederajat</option>
                                        <option value="Diploma 1, 2, atau 3">Diploma 1, 2, atau 3</option>
                                        <option value="Strata 1">Strata 1 (Sarjana S1)</option>
                                        <option value="Strata 2 atau Strata 3">Strata 2 atau Strata 3 (Pascasarjana)</option>
                                    </select>
                                    @error('jenjang_paling_sesuai') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Dampak Sertifikasi BNSP (Jika punya sertifikat) -->
                            @if($pernah_sertifikasi_lsp === 'Ya' && $dapat_sertifikat_bnsp === 'Ya')
                                <div class="pt-4 border-t border-gray-200 space-y-5">
                                    <h4 class="font-bold text-gray-800 text-sm tracking-wider uppercase border-b pb-1">Dampak Pemilikan Sertifikat Kompetensi BNSP</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Memudahkan Dapat Kerja -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Apakah sertifikat kompetensi BNSP membantu mendapat kerja / berwirausaha dengan lebih mudah? <span class="text-red-500">*</span></label>
                                            <select wire:model="bnsp_mudahkan_dapat_kerja" class="w-full rounded-xl @error('bnsp_mudahkan_dapat_kerja') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                                <option value="">-- Pilih --</option>
                                                <option value="Tidak mendukung sama sekali">1. Tidak mendukung sama sekali</option>
                                                <option value="Sedikit mendukung">2. Sedikit mendukung</option>
                                                <option value="Cukup Mendukung">3. Cukup mendukung</option>
                                                <option value="Mendukung">4. Mendukung</option>
                                                <option value="Sangat Mendukung">5. Sangat mendukung</option>
                                            </select>
                                            @error('bnsp_mudahkan_dapat_kerja') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Perusahaan Menghargai BNSP -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Apakah perusahaan / instansi menghargai sertifikat kompetensi dari BNSP yang Anda miliki? <span class="text-red-500">*</span></label>
                                            <select wire:model="perusahaan_hargai_bnsp" class="w-full rounded-xl @error('perusahaan_hargai_bnsp') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                                <option value="">-- Pilih --</option>
                                                <option value="Tidak menyambut sama sekali">1. Tidak menghargai/menyambut sama sekali</option>
                                                <option value="Sedikit menyambut baik">2. Sedikit menyambut baik</option>
                                                <option value="Cukup menyambut baik">3. Cukup menyambut baik</option>
                                                <option value="Menyambut baik">4. Menyambut baik</option>
                                                <option value="Sangat menyambut baik">5. Sangat menyambut baik</option>
                                            </select>
                                            @error('perusahaan_hargai_bnsp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Dampak Peningkatan Karir -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Apakah sertifikat kompetensi BNSP berdampak pada peningkatan jenjang karir Anda? <span class="text-red-500">*</span></label>
                                            <select wire:model="bnsp_tingkatkan_karir" class="w-full rounded-xl @error('bnsp_tingkatkan_karir') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                                <option value="">-- Pilih --</option>
                                                <option value="Tidak Berdampak Terhadap Peningkatan Karir Sama Sekali">1. Tidak berdampak sama sekali</option>
                                                <option value="Sedikit Berdampak Terhadap Peningkatan Karir">2. Sedikit berdampak</option>
                                                <option value="Cukup Berdampak Terhadap Peningkatan Karir">3. Cukup berdampak</option>
                                                <option value="Berdampak Terhadap Peningkatan Karir">4. Berdampak terhadap karir</option>
                                                <option value="Sangat Berdampak Terhadap Peningkatan Karir">5. Sangat berdampak terhadap karir</option>
                                            </select>
                                            @error('bnsp_tingkatkan_karir') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Dampak Peningkatan Gaji -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Apakah sertifikat kompetensi BNSP berdampak pada peningkatan pendapatan/gaji Anda? <span class="text-red-500">*</span></label>
                                            <select wire:model="bnsp_tingkatkan_gaji" class="w-full rounded-xl @error('bnsp_tingkatkan_gaji') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                                <option value="">-- Pilih --</option>
                                                <option value="Tidak Berdampak Terhadap Peningkatan Pendapatan/Gaji Sama Sekali">1. Tidak berdampak sama sekali</option>
                                                <option value="Sedikit Berdampak Terhadap Peningkatan Pendapatan/Gaji">2. Sedikit berdampak</option>
                                                <option value="Cukup Berdampak Terhadap Peningkatan Pendapatan/Gaji">3. Cukup berdampak</option>
                                                <option value="Berdampak Terhadap Peningkatan Pendapatan/Gaji">4. Berdampak terhadap gaji</option>
                                                <option value="Sangat Berdampak Terhadap Peningkatan Pendapatan/Gaji">5. Sangat berdampak terhadap gaji</option>
                                            </select>
                                            @error('bnsp_tingkatkan_gaji') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Kesesuaian Pekerjaan Dengan Bidang Sertifikat -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Apakah pekerjaan saat ini sudah sesuai dengan bidang sertifikat kompetensi BNSP? <span class="text-red-500">*</span></label>
                                            <select wire:model="kesesuaian_bidang_bnsp" class="w-full rounded-xl @error('kesesuaian_bidang_bnsp') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border bg-white transition duration-150">
                                                <option value="">-- Pilih --</option>
                                                <option value="Ya">Ya (Sesuai)</option>
                                                <option value="Tidak">Tidak (Tidak Sesuai)</option>
                                            </select>
                                            @error('kesesuaian_bidang_bnsp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div></div>

                                        <!-- Jabatan Sebelum BNSP -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Jabatan / Posisi Anda SEBELUM memiliki Sertifikat BNSP <span class="text-red-500">*</span></label>
                                            <input type="text" wire:model="jabatan_sebelum_bnsp" class="w-full rounded-xl @error('jabatan_sebelum_bnsp') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border transition duration-150" placeholder="Ketik nama jabatan sebelum sertifikasi...">
                                            @error('jabatan_sebelum_bnsp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Jabatan Setelah BNSP -->
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Jabatan / Posisi Anda SETELAH memiliki Sertifikat BNSP <span class="text-red-500">*</span></label>
                                            <input type="text" wire:model="jabatan_setelah_bnsp" class="w-full rounded-xl @error('jabatan_setelah_bnsp') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror p-2.5 border transition duration-150" placeholder="Ketik nama jabatan setelah sertifikasi...">
                                            @error('jabatan_setelah_bnsp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

            <!-- NAVIGATION BUTTONS -->
            <div class="flex justify-between items-center mt-6">
                <!-- Back Button -->
                <div>
                    @if($currentStep > 1)
                        <button type="button" wire:click="backStep" class="px-6 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-xl font-medium shadow-sm transition duration-150 inline-flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            <span>Kembali</span>
                        </button>
                    @endif
                </div>

                <!-- Next/Submit Button -->
                <div>
                    @if($currentStep < 4)
                        <button type="button" wire:click="nextStep" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium shadow-sm transition duration-150 inline-flex items-center space-x-2">
                            <span>Selanjutnya</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    @else
                        <button type="submit" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold shadow-md transition duration-150 inline-flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Kirim Kuisioner</span>
                        </button>
                    @endif
                </div>
            </div>
        </form>
        @endif
    @endif
</div>

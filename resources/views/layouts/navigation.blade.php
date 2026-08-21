<x-app-layout>
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Header Identity -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <img src="{{ asset('logo-tvri.svg') }}" alt="TVRI Bengkulu" class="h-14 w-auto object-contain">
                <div>
                    <h1 class="text-2xl font-bold text-[#003366]">LPP TVRI Stasiun Bengkulu</h1>
                    <p class="text-sm text-gray-500 font-medium">Sistem Pengiriman Laporan Kegiatan Staf Teknisi</p>
                </div>
            </div>

            <!-- Banner User Welcome -->
            <div class="bg-[#003366] text-white p-6 rounded-2xl shadow-md flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold">Halo, {{ Auth::user()->name }}!</h2>
                    <p class="text-xs text-blue-100 mt-1">Isi formulir di bawah untuk melaporkan pemeliharaan atau perbaikan teknis secara real-time.</p>
                </div>
                <span class="bg-white/20 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm">
                    Teknisi TVRI
                </span>
            </div>

            <!-- Card Form Laporan -->
            <div class="bg-white shadow-sm sm:rounded-2xl border-t-4 border-[#003366] p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Formulir Laporan Teknisi</h3>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded-r-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Grid 2 Kolom untuk Lokasi & Asal Teknisi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-semibold text-sm text-gray-700 mb-2">Lokasi Pengerjaan</label>
                            <input type="text" name="lokasi" placeholder="Contoh: Studio Utama / Stasiun Pemancar Bentiring" required 
                                class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-[#003366] focus:border-[#003366] text-sm py-3 px-4">
                        </div>

                        <div>
                            <label class="block font-semibold text-sm text-gray-700 mb-2">Bidang / Asal Teknisi</label>
                            <select name="asal_teknisi" required class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-[#003366] focus:border-[#003366] text-sm py-3 px-4">
                                <option value="" disabled selected>-- Pilih Bidang Teknisi --</option>
                                <option value="Teknisi Transmisi & Pemancar">Teknisi Transmisi & Pemancar</option>
                                <option value="Teknisi Studio & Produksi">Teknisi Studio & Produksi</option>
                                <option value="Teknisi IT & Jaringan">Teknisi IT & Jaringan</option>
                                <option value="Teknisi Sarpras & Kelistrikan">Teknisi Sarpras & Kelistrikan (ME)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tugas yang Dikerjakan -->
                    <div>
                        <label class="block font-semibold text-sm text-gray-700 mb-2">Tugas / Kegiatan yang Dikerjakan</label>
                        <textarea name="isi_laporan" rows="5" placeholder="Jelaskan secara rinci tugas atau pemeliharaan yang dilakukan..." required 
                            class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-[#003366] focus:border-[#003366] text-sm p-4"></textarea>
                    </div>

                    <!-- Grid 2 Kolom untuk Status & Foto Real-time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-semibold text-sm text-gray-700 mb-2">Status Pengerjaan</label>
                            <select name="status" required class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-[#003366] focus:border-[#003366] text-sm py-3 px-4">
                                <option value="Selesai">Selesai</option>
                                <option value="Dalam Proses">Dalam Proses</option>
                                <option value="Ada Kendala">Ada Kendala</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-semibold text-sm text-gray-700 mb-2">Foto Lapangan (Real-time)</label>
                            <input type="file" name="foto" accept="image/*" capture="environment" required 
                                class="w-full border border-gray-300 rounded-xl text-sm p-2.5 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#003366] file:text-white hover:file:bg-[#002244]">
                            <p class="text-[11px] text-gray-500 mt-1">*Ambil foto lokasi/peralatan secara langsung.</p>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" 
                            class="bg-[#003366] hover:bg-[#002244] text-white font-bold py-3.5 px-8 rounded-xl shadow-md transition duration-200 text-sm tracking-wider uppercase">
                            Kirim Laporan Teknisi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
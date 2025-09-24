@extends('layouts.app')

@section('title', '- Kebijakan Privasi')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Kebijakan Privasi
            </h1>
            <p class="text-lg transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                Terakhir diperbarui: {{ date('d M Y') }}
            </p>
        </div>

        <!-- Content -->
        <div class="rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            
            <div class="prose max-w-none transition-colors duration-300"
                 :class="{ 'prose-gray': !darkMode, 'prose-invert': darkMode }">
                
                <h2>1. Informasi yang Kami Kumpulkan</h2>
                <p>Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, termasuk:</p>
                <ul>
                    <li>Informasi akun (nama, email, password)</li>
                    <li>Informasi profil (tanggal lahir, jenis kelamin, nomor telepon)</li>
                    <li>Hasil assessment kesehatan mental</li>
                    <li>Riwayat percakapan konseling</li>
                    <li>Interaksi dengan konten (like, bookmark, share)</li>
                </ul>

                <h2>2. Bagaimana Kami Menggunakan Informasi</h2>
                <p>Informasi yang kami kumpulkan digunakan untuk:</p>
                <ul>
                    <li>Menyediakan dan meningkatkan layanan kami</li>
                    <li>Memberikan rekomendasi konten yang dipersonalisasi</li>
                    <li>Memfasilitasi sesi konseling</li>
                    <li>Mengirim notifikasi dan reminder</li>
                    <li>Menganalisis penggunaan platform untuk perbaikan</li>
                </ul>

                <h2>3. Keamanan Data</h2>
                <p>Kami menerapkan langkah-langkah keamanan yang ketat untuk melindungi informasi Anda:</p>
                <ul>
                    <li>Enkripsi data sensitif (hasil assessment, pesan konseling)</li>
                    <li>Akses terbatas hanya untuk personel yang berwenang</li>
                    <li>Monitoring keamanan 24/7</li>
                    <li>Backup data reguler dengan enkripsi</li>
                    <li>Compliance dengan standar keamanan internasional</li>
                </ul>

                <h2>4. Berbagi Informasi</h2>
                <p>Kami tidak akan menjual, menyewakan, atau membagikan informasi pribadi Anda kepada pihak ketiga, kecuali:</p>
                <ul>
                    <li>Dengan persetujuan eksplisit dari Anda</li>
                    <li>Untuk mematuhi kewajiban hukum</li>
                    <li>Dalam situasi darurat untuk melindungi keselamatan</li>
                    <li>Dengan penyedia layanan yang terikat kontrak kerahasiaan</li>
                </ul>

                <h2>5. Hak Anda</h2>
                <p>Anda memiliki hak untuk:</p>
                <ul>
                    <li>Mengakses dan memperbarui informasi pribadi Anda</li>
                    <li>Menghapus akun dan data Anda</li>
                    <li>Mengunduh data Anda dalam format yang dapat dibaca</li>
                    <li>Membatasi pemrosesan data tertentu</li>
                    <li>Menarik persetujuan kapan saja</li>
                </ul>

                <h2>6. Cookies dan Teknologi Pelacakan</h2>
                <p>Kami menggunakan cookies dan teknologi serupa untuk:</p>
                <ul>
                    <li>Mengingat preferensi Anda (dark mode, bahasa)</li>
                    <li>Menjaga sesi login Anda</li>
                    <li>Menganalisis penggunaan website</li>
                    <li>Meningkatkan pengalaman pengguna</li>
                </ul>

                <h2>7. Penyimpanan Data</h2>
                <p>Data Anda disimpan selama:</p>
                <ul>
                    <li>Akun aktif: selama akun Anda aktif</li>
                    <li>Hasil assessment: 7 tahun untuk keperluan medis</li>
                    <li>Riwayat konseling: 5 tahun sesuai standar profesional</li>
                    <li>Log aktivitas: 2 tahun untuk keamanan</li>
                </ul>

                <h2>8. Privasi Anak</h2>
                <p>Layanan kami tidak ditujukan untuk anak di bawah 18 tahun. Jika Anda berusia di bawah 18 tahun, harap gunakan layanan ini dengan pengawasan orang tua atau wali.</p>

                <h2>9. Perubahan Kebijakan</h2>
                <p>Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan material akan diberitahukan melalui email atau notifikasi di platform.</p>

                <h2>10. Hubungi Kami</h2>
                <p>Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami:</p>
                <ul>
                    <li>Email: privacy@mindcare.com</li>
                    <li>Telepon: +62 21 1234 5678</li>
                    <li>Alamat: Jakarta, Indonesia</li>
                </ul>

                <div class="mt-8 p-4 rounded-lg transition-colors duration-300"
                     :class="{ 'bg-blue-50 border border-blue-200': !darkMode, 'bg-blue-900/20 border border-blue-800': darkMode }">
                    <p class="text-sm font-medium transition-colors duration-300"
                       :class="{ 'text-blue-800': !darkMode, 'text-blue-200': darkMode }">
                        <i class="fas fa-info-circle mr-2"></i>
                        Dengan menggunakan layanan MindCare, Anda menyetujui pengumpulan dan penggunaan informasi sesuai dengan kebijakan privasi ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
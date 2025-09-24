@extends('layouts.app')

@section('title', '- Syarat & Ketentuan')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Syarat & Ketentuan
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
                
                <h2>1. Penerimaan Syarat</h2>
                <p>Dengan mengakses dan menggunakan platform MindCare, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju dengan syarat ini, harap tidak menggunakan layanan kami.</p>

                <h2>2. Deskripsi Layanan</h2>
                <p>MindCare adalah platform kesehatan mental digital yang menyediakan:</p>
                <ul>
                    <li>Self-assessment kesehatan mental</li>
                    <li>Konten edukasi (artikel, video, kuis)</li>
                    <li>Layanan konseling online</li>
                    <li>Komunitas support group</li>
                    <li>Blog dan informasi kesehatan mental</li>
                </ul>

                <h2>3. Persyaratan Pengguna</h2>
                <p>Untuk menggunakan layanan kami, Anda harus:</p>
                <ul>
                    <li>Berusia minimal 18 tahun atau memiliki persetujuan orang tua/wali</li>
                    <li>Memberikan informasi yang akurat dan lengkap</li>
                    <li>Menjaga kerahasiaan akun dan password Anda</li>
                    <li>Bertanggung jawab atas semua aktivitas di akun Anda</li>
                </ul>

                <h2>4. Penggunaan yang Dilarang</h2>
                <p>Anda dilarang untuk:</p>
                <ul>
                    <li>Menggunakan layanan untuk tujuan ilegal atau tidak sah</li>
                    <li>Mengganggu atau merusak sistem keamanan</li>
                    <li>Menyebarkan konten yang melanggar hukum, menyinggung, atau berbahaya</li>
                    <li>Menyamar sebagai orang lain atau entitas lain</li>
                    <li>Menggunakan bot atau sistem otomatis tanpa izin</li>
                </ul>

                <h2>5. Konten Pengguna</h2>
                <p>Dengan mengirimkan konten ke platform kami, Anda:</p>
                <ul>
                    <li>Memberikan lisensi untuk menggunakan, memodifikasi, dan menampilkan konten tersebut</li>
                    <li>Menjamin bahwa Anda memiliki hak atas konten tersebut</li>
                    <li>Bertanggung jawab atas keakuratan dan legalitas konten</li>
                </ul>

                <h2>6. Privasi dan Kerahasiaan</h2>
                <p>Kami berkomitmen untuk melindungi privasi Anda:</p>
                <ul>
                    <li>Informasi pribadi akan dijaga kerahasiaannya</li>
                    <li>Data kesehatan mental dienkripsi dan diamankan</li>
                    <li>Akses terbatas hanya untuk personel yang berwenang</li>
                    <li>Tidak ada pembagian data tanpa persetujuan Anda</li>
                </ul>

                <h2>7. Layanan Konseling</h2>
                <p>Untuk layanan konseling online:</p>
                <ul>
                    <li>Layanan ini bukan pengganti perawatan medis profesional</li>
                    <li>Dalam situasi darurat, segera hubungi layanan darurat lokal</li>
                    <li>Konselor kami terikat kode etik profesional</li>
                    <li>Sesi dapat direkam untuk tujuan kualitas dan pelatihan</li>
                </ul>

                <h2>8. Disclaimer Medis</h2>
                <p>Penting untuk diketahui:</p>
                <ul>
                    <li>Layanan kami tidak menggantikan diagnosis atau perawatan medis profesional</li>
                    <li>Assessment online adalah alat skrining, bukan diagnosis</li>
                    <li>Selalu konsultasikan dengan profesional kesehatan untuk masalah serius</li>
                    <li>Kami tidak bertanggung jawab atas keputusan medis berdasarkan layanan kami</li>
                </ul>

                <h2>9. Pembayaran dan Refund</h2>
                <p>Untuk layanan berbayar:</p>
                <ul>
                    <li>Pembayaran harus dilakukan sebelum mengakses layanan premium</li>
                    <li>Refund dapat diberikan sesuai kebijakan yang berlaku</li>
                    <li>Harga dapat berubah dengan pemberitahuan sebelumnya</li>
                </ul>

                <h2>10. Pembatasan Tanggung Jawab</h2>
                <p>MindCare tidak bertanggung jawab atas:</p>
                <ul>
                    <li>Kerugian langsung atau tidak langsung dari penggunaan layanan</li>
                    <li>Gangguan teknis atau downtime sistem</li>
                    <li>Keputusan yang dibuat berdasarkan informasi dari platform</li>
                    <li>Konten yang dibuat oleh pengguna lain</li>
                </ul>

                <h2>11. Perubahan Layanan</h2>
                <p>Kami berhak untuk:</p>
                <ul>
                    <li>Memodifikasi atau menghentikan layanan kapan saja</li>
                    <li>Memperbarui syarat dan ketentuan ini</li>
                    <li>Menghapus atau memodifikasi konten yang melanggar</li>
                    <li>Menangguhkan atau menghapus akun yang melanggar</li>
                </ul>

                <h2>12. Penyelesaian Sengketa</h2>
                <p>Setiap sengketa akan diselesaikan melalui:</p>
                <ul>
                    <li>Mediasi terlebih dahulu</li>
                    <li>Arbitrase jika mediasi gagal</li>
                    <li>Hukum Indonesia yang berlaku</li>
                    <li>Yurisdiksi pengadilan Jakarta</li>
                </ul>

                <h2>13. Kontak</h2>
                <p>Untuk pertanyaan tentang syarat dan ketentuan ini:</p>
                <ul>
                    <li>Email: legal@mindcare.com</li>
                    <li>Telepon: +62 21 1234 5678</li>
                    <li>Alamat: Jakarta, Indonesia</li>
                </ul>

                <div class="mt-8 p-4 rounded-lg transition-colors duration-300"
                     :class="{ 'bg-yellow-50 border border-yellow-200': !darkMode, 'bg-yellow-900/20 border border-yellow-800': darkMode }">
                    <p class="text-sm font-medium transition-colors duration-300"
                       :class="{ 'text-yellow-800': !darkMode, 'text-yellow-200': darkMode }">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Syarat dan ketentuan ini dapat berubah sewaktu-waktu. Perubahan akan diberitahukan melalui email atau notifikasi di platform.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
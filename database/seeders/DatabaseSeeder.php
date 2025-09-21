<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Content;
use App\Models\Blog;
use App\Models\CommunityLink;
use App\Models\Assessment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin MindCare',
            'email' => 'admin@mindcare.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'consent_given' => true,
            'consent_given_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Create staff user
        $staff = User::create([
            'name' => 'Staff Konselor',
            'email' => 'staff@mindcare.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'consent_given' => true,
            'consent_given_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Create test user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@mindcare.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'consent_given' => true,
            'consent_given_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Create sample content
        $contents = [
            [
                'title' => 'Mengenal Gangguan Kecemasan dan Cara Mengatasinya',
                'slug' => 'mengenal-gangguan-kecemasan-dan-cara-mengatasinya',
                'type' => 'article',
                'excerpt' => 'Gangguan kecemasan adalah kondisi mental yang umum terjadi. Artikel ini membahas jenis-jenis kecemasan dan strategi mengatasinya.',
                'body' => '<h2>Apa itu Gangguan Kecemasan?</h2><p>Gangguan kecemasan adalah kondisi kesehatan mental yang ditandai dengan perasaan khawatir, takut, atau cemas yang berlebihan dan terus-menerus. Kondisi ini dapat mengganggu aktivitas sehari-hari dan kualitas hidup seseorang.</p><h3>Jenis-jenis Gangguan Kecemasan</h3><ul><li><strong>Generalized Anxiety Disorder (GAD)</strong> - Kecemasan umum yang berlebihan</li><li><strong>Panic Disorder</strong> - Serangan panik yang tiba-tiba</li><li><strong>Social Anxiety Disorder</strong> - Kecemasan dalam situasi sosial</li><li><strong>Specific Phobias</strong> - Ketakutan berlebihan terhadap objek atau situasi tertentu</li></ul><h3>Cara Mengatasi Kecemasan</h3><ol><li>Teknik pernapasan dan relaksasi</li><li>Olahraga teratur</li><li>Mindfulness dan meditasi</li><li>Terapi kognitif-behavioral</li><li>Dukungan dari keluarga dan teman</li></ol><p>Jika kecemasan sudah mengganggu kehidupan sehari-hari, jangan ragu untuk mencari bantuan profesional.</p>',
                'category' => 'kecemasan',
                'tags' => ['kecemasan', 'mental health', 'self-help'],
                'featured' => true,
                'published' => true,
                'created_by' => $staff->id,
                'published_at' => now()->subDays(7),
                'views' => 1250,
                'likes' => 89,
                'reading_time' => 5,
            ],
            [
                'title' => 'Video: Teknik Mindfulness untuk Pemula',
                'slug' => 'video-teknik-mindfulness-untuk-pemula',
                'type' => 'video',
                'excerpt' => 'Pelajari teknik mindfulness dasar yang bisa Anda praktikkan setiap hari untuk mengurangi stres dan meningkatkan kesejahteraan mental.',
                'body' => '<p>Video ini akan mengajarkan Anda teknik-teknik mindfulness dasar yang mudah dipraktikkan. Mindfulness adalah praktik kesadaran penuh yang dapat membantu mengurangi stres, kecemasan, dan meningkatkan fokus.</p><h3>Yang akan Anda pelajari:</h3><ul><li>Pengertian mindfulness</li><li>Teknik pernapasan mindful</li><li>Body scan meditation</li><li>Mindful walking</li><li>Tips praktik harian</li></ul>',
                'video_url' => 'https://www.youtube.com/watch?v=ZToicYcHIOU',
                'category' => 'mindfulness',
                'tags' => ['mindfulness', 'meditation', 'stress relief'],
                'featured' => true,
                'published' => true,
                'created_by' => $staff->id,
                'published_at' => now()->subDays(5),
                'views' => 2150,
                'likes' => 156,
            ],
            [
                'title' => 'Kuis: Seberapa Baik Anda Mengelola Stres?',
                'slug' => 'kuis-seberapa-baik-anda-mengelola-stres',
                'type' => 'quiz',
                'excerpt' => 'Tes interaktif untuk mengetahui seberapa efektif strategi manajemen stres yang Anda gunakan selama ini.',
                'body' => '<p>Kuis ini dirancang untuk membantu Anda memahami kemampuan manajemen stres Anda saat ini. Dengan mengetahui kekuatan dan area yang perlu diperbaiki, Anda dapat mengembangkan strategi yang lebih efektif.</p>',
                'quiz_data' => [
                    'questions' => [
                        [
                            'question' => 'Bagaimana Anda biasanya bereaksi ketika menghadapi situasi yang membuat stres?',
                            'options' => [
                                'Panik dan merasa kewalahan',
                                'Mencoba tetap tenang dan mencari solusi',
                                'Menghindar dari situasi tersebut',
                                'Mencari bantuan dari orang lain'
                            ],
                            'correct' => 1
                        ],
                        [
                            'question' => 'Seberapa sering Anda melakukan aktivitas relaksasi?',
                            'options' => [
                                'Setiap hari',
                                'Beberapa kali seminggu',
                                'Jarang sekali',
                                'Tidak pernah'
                            ],
                            'correct' => 0
                        ],
                        [
                            'question' => 'Ketika merasa stres, apa yang paling sering Anda lakukan?',
                            'options' => [
                                'Tidur atau menghindari masalah',
                                'Berbicara dengan orang yang dipercaya',
                                'Melakukan aktivitas fisik',
                                'Makan atau minum berlebihan'
                            ],
                            'correct' => 2
                        ]
                    ],
                    'scoring' => [
                        'excellent' => 'Anda memiliki kemampuan manajemen stres yang sangat baik!',
                        'good' => 'Anda cukup baik dalam mengelola stres, namun masih bisa ditingkatkan.',
                        'fair' => 'Kemampuan manajemen stres Anda perlu diperbaiki.',
                        'poor' => 'Anda perlu belajar teknik manajemen stres yang lebih efektif.'
                    ]
                ],
                'category' => 'stress-management',
                'tags' => ['stress', 'quiz', 'self-assessment'],
                'featured' => false,
                'published' => true,
                'created_by' => $staff->id,
                'published_at' => now()->subDays(3),
                'views' => 875,
                'likes' => 67,
            ],
        ];

        foreach ($contents as $contentData) {
            Content::create($contentData);
        }

        // Create sample blogs
        $blogs = [
            [
                'title' => '5 Tanda Anda Perlu Istirahat dari Media Sosial',
                'slug' => '5-tanda-anda-perlu-istirahat-dari-media-sosial',
                'excerpt' => 'Media sosial dapat berdampak negatif pada kesehatan mental. Kenali tanda-tanda bahwa Anda perlu digital detox.',
                'body' => '<p>Di era digital ini, media sosial telah menjadi bagian tak terpisahkan dari kehidupan sehari-hari. Namun, penggunaan yang berlebihan dapat berdampak negatif pada kesehatan mental kita.</p><h2>Tanda-tanda Anda Perlu Digital Detox</h2><h3>1. Merasa Cemas Ketika Tidak Bisa Mengakses Media Sosial</h3><p>Jika Anda merasa gelisah atau cemas ketika ponsel mati atau tidak ada sinyal internet, ini bisa menjadi tanda kecanduan media sosial.</p><h3>2. Membandingkan Hidup Anda dengan Orang Lain</h3><p>Constantly comparing your life to the curated versions you see online can lead to feelings of inadequacy and low self-esteem.</p><h3>3. Kesulitan Fokus pada Tugas Sehari-hari</h3><p>Jika Anda terus-menerus terganggu oleh notifikasi atau merasa perlu mengecek media sosial setiap beberapa menit, produktivitas Anda mungkin terganggu.</p><h3>4. Merasa Lelah Setelah Menggunakan Media Sosial</h3><p>Scrolling endless feeds can be mentally exhausting and leave you feeling drained rather than entertained or informed.</p><h3>5. Mengabaikan Hubungan di Dunia Nyata</h3><p>Jika Anda lebih memilih berinteraksi online daripada bertemu teman atau keluarga secara langsung, mungkin saatnya untuk mundur sejenak.</p><h2>Tips untuk Digital Detox</h2><ul><li>Tetapkan waktu khusus untuk mengecek media sosial</li><li>Matikan notifikasi untuk aplikasi media sosial</li><li>Lakukan aktivitas offline yang Anda nikmati</li><li>Habiskan waktu berkualitas dengan orang-orang terdekat</li><li>Praktikkan mindfulness dan meditasi</li></ul><p>Ingat, media sosial adalah alat yang seharusnya memperkaya hidup Anda, bukan mengendalikannya. Jangan ragu untuk mengambil jeda ketika diperlukan.</p>',
                'featured_image' => 'https://images.pexels.com/photos/267350/pexels-photo-267350.jpeg',
                'category' => 'Digital Wellness',
                'tags' => ['social media', 'digital detox', 'mental health', 'wellness'],
                'featured' => true,
                'published' => true,
                'author_id' => $admin->id,
                'published_at' => now()->subDays(2),
                'views' => 3240,
                'reading_time' => 4,
                'seo_meta' => [
                    'title' => '5 Tanda Anda Perlu Istirahat dari Media Sosial - MindCare',
                    'description' => 'Pelajari tanda-tanda bahwa Anda perlu digital detox dan tips praktis untuk mengurangi penggunaan media sosial.',
                    'keywords' => 'digital detox, media sosial, kesehatan mental, wellness, mindfulness'
                ],
            ],
            [
                'title' => 'Cara Membangun Rutinitas Pagi yang Mendukung Kesehatan Mental',
                'slug' => 'cara-membangun-rutinitas-pagi-yang-mendukung-kesehatan-mental',
                'excerpt' => 'Rutinitas pagi yang baik dapat mengatur mood dan energi sepanjang hari. Pelajari cara membangun morning routine yang efektif.',
                'body' => '<p>Cara Anda memulai pagi dapat sangat mempengaruhi suasana hati dan tingkat energi sepanjang hari. Rutinitas pagi yang terstruktur dan positif dapat menjadi fondasi yang kuat untuk kesehatan mental yang optimal.</p><h2>Mengapa Rutinitas Pagi Penting?</h2><p>Rutinitas pagi membantu:</p><ul><li>Mengatur ritme sirkadian tubuh</li><li>Mengurangi keputusan harian yang melelahkan</li><li>Memberikan rasa kontrol dan stabilitas</li><li>Meningkatkan mood dan energi</li><li>Menyiapkan mindset positif untuk hari</li></ul><h2>Komponen Rutinitas Pagi yang Sehat</h2><h3>1. Bangun pada Waktu yang Konsisten</h3><p>Consistency is key. Try to wake up at the same time every day, even on weekends, to regulate your biological clock.</p><h3>2. Hidrasi Segera</h3><p>Drink a glass of water immediately after waking up to rehydrate your body and kickstart your metabolism.</p><h3>3. Gerakan Fisik Ringan</h3><p>Whether it\'s stretching, yoga, or a short walk, gentle physical activity helps awaken your body and mind.</p><h3>4. Praktik Mindfulness</h3><p>Spend 5-10 minutes in meditation, deep breathing, or journaling to center yourself for the day ahead.</p><h3>5. Nutrisi yang Baik</h3><p>Fuel your body with a healthy breakfast that includes protein, healthy fats, and complex carbohydrates.</p><h3>6. Hindari Langsung Mengecek Ponsel</h3><p>Give yourself at least 30 minutes of phone-free time in the morning to avoid immediate stress from notifications.</p><h2>Tips Membangun Rutinitas Baru</h2><ol><li><strong>Mulai Kecil</strong> - Tambahkan satu kebiasaan baru setiap minggu</li><li><strong>Konsisten</strong> - Lakukan rutinitas yang sama setiap hari</li><li><strong>Fleksibel</strong> - Sesuaikan dengan jadwal dan kebutuhan Anda</li><li><strong>Nikmati Prosesnya</strong> - Pilih aktivitas yang Anda sukai</li><li><strong>Tracking Progress</strong> - Catat kemajuan untuk mempertahankan motivasi</li></ol><p>Remember, the best morning routine is one that works for your lifestyle and makes you feel good. Experiment with different activities and find what energizes and centers you.</p>',
                'featured_image' => 'https://images.pexels.com/photos/6214471/pexels-photo-6214471.jpeg',
                'category' => 'Self-Care',
                'tags' => ['morning routine', 'self-care', 'habits', 'wellness', 'productivity'],
                'featured' => true,
                'published' => true,
                'author_id' => $staff->id,
                'published_at' => now()->subDays(1),
                'views' => 1890,
                'reading_time' => 6,
                'seo_meta' => [
                    'title' => 'Cara Membangun Rutinitas Pagi untuk Kesehatan Mental - MindCare',
                    'description' => 'Pelajari cara membangun morning routine yang efektif untuk meningkatkan mood dan energi sepanjang hari.',
                    'keywords' => 'rutinitas pagi, kesehatan mental, self-care, morning routine, wellness'
                ],
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::create($blogData);
        }

        // Create community links
        $communityLinks = [
            [
                'platform' => 'discord',
                'name' => 'MindCare Support Community',
                'url' => 'https://discord.gg/mindcare',
                'description' => 'Komunitas support group untuk saling berbagi dan mendukung dalam perjalanan kesehatan mental.',
                'member_count' => 2456,
                'active' => true,
                'sort_order' => 1,
            ],
            [
                'platform' => 'telegram',
                'name' => 'MindCare Daily Tips',
                'url' => 'https://t.me/mindcare_tips',
                'description' => 'Channel Telegram untuk tips harian kesehatan mental dan motivasi positif.',
                'member_count' => 1789,
                'active' => true,
                'sort_order' => 2,
            ],
            [
                'platform' => 'discord',
                'name' => 'MindCare Peer Support',
                'url' => 'https://discord.gg/mindcare-peer',
                'description' => 'Grup khusus untuk peer support dan sharing pengalaman recovery.',
                'member_count' => 892,
                'active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($communityLinks as $linkData) {
            CommunityLink::create($linkData);
        }

        // Create sample assessments
        $assessments = [
            [
                'user_id' => $user->id,
                'test_type' => 'phq-9',
                'answers' => [1, 1, 0, 2, 1, 0, 1, 0, 0], // Mild depression
                'score' => 6,
                'severity_level' => 'mild',
                'result' => [
                    'score' => 6,
                    'severity_level' => 'mild',
                    'interpretation' => 'Gejala depresi ringan'
                ],
                'recommendations' => 'Gejala depresi ringan. Pertimbangkan untuk berbicara dengan konselor atau terapis.',
                'completed_at' => now()->subDays(10),
            ],
            [
                'user_id' => $user->id,
                'test_type' => 'gad-7',
                'answers' => [2, 1, 2, 1, 1, 0, 1], // Moderate anxiety
                'score' => 8,
                'severity_level' => 'mild',
                'result' => [
                    'score' => 8,
                    'severity_level' => 'mild',
                    'interpretation' => 'Gejala kecemasan ringan'
                ],
                'recommendations' => 'Gejala kecemasan ringan. Pertimbangkan teknik relaksasi dan mindfulness.',
                'completed_at' => now()->subDays(8),
            ],
        ];

        foreach ($assessments as $assessmentData) {
            Assessment::create($assessmentData);
        }

        $this->command->info('Database seeding completed!');
    }
}
<?php

return [
    'phq-9' => [
        'name' => 'Patient Health Questionnaire-9 (PHQ-9)',
        'description' => 'Skrining untuk gangguan depresi mayor',
        'questions' => [
            'Sedikit tertarik atau senang melakukan sesuatu',
            'Merasa sedih, tertekan, atau putus asa',
            'Kesulitan tidur, tetap tertidur, atau tidur terlalu banyak',
            'Merasa lelah atau memiliki sedikit energi',
            'Nafsu makan buruk atau makan berlebihan',
            'Merasa buruk tentang diri sendiri - atau bahwa Anda gagal atau mengecewakan diri sendiri atau keluarga Anda',
            'Kesulitan berkonsentrasi pada hal-hal seperti membaca koran atau menonton televisi',
            'Bergerak atau berbicara begitu lambat sehingga orang lain bisa memperhatikan - atau sebaliknya, sangat gelisah atau gelisah sehingga Anda bergerak lebih banyak dari biasanya',
            'Pikiran bahwa Anda lebih baik mati, atau menyakiti diri sendiri dengan cara tertentu'
        ],
        'options' => [
            0 => 'Tidak sama sekali',
            1 => 'Beberapa hari',
            2 => 'Lebih dari setengah hari',
            3 => 'Hampir setiap hari'
        ],
        'thresholds' => [
            'minimal' => ['min' => 0, 'max' => 4],
            'mild' => ['min' => 5, 'max' => 9],
            'moderate' => ['min' => 10, 'max' => 14],
            'moderately_severe' => ['min' => 15, 'max' => 19],
            'severe' => ['min' => 20, 'max' => 27]
        ],
        'recommendations' => [
            'minimal' => 'Tidak ada gejala depresi yang signifikan. Pertahankan gaya hidup sehat.',
            'mild' => 'Gejala depresi ringan. Pertimbangkan untuk berbicara dengan konselor atau terapis.',
            'moderate' => 'Gejala depresi sedang. Disarankan untuk berkonsultasi dengan profesional kesehatan mental.',
            'moderately_severe' => 'Gejala depresi yang cukup parah. Sangat disarankan untuk segera berkonsultasi dengan psikolog atau psikiater.',
            'severe' => 'Gejala depresi berat. Segera hubungi profesional kesehatan mental atau layanan darurat.'
        ]
    ],
    
    'gad-7' => [
        'name' => 'Generalized Anxiety Disorder 7-item (GAD-7)',
        'description' => 'Skrining untuk gangguan kecemasan umum',
        'questions' => [
            'Merasa gugup, cemas, atau tegang',
            'Tidak dapat berhenti atau mengontrol kekhawatiran',
            'Terlalu khawatir tentang berbagai hal',
            'Kesulitan untuk rileks',
            'Sangat gelisah sehingga sulit untuk duduk diam',
            'Mudah marah atau mudah tersinggung',
            'Merasa takut seolah-olah sesuatu yang mengerikan mungkin terjadi'
        ],
        'options' => [
            0 => 'Tidak sama sekali',
            1 => 'Beberapa hari',
            2 => 'Lebih dari setengah hari',
            3 => 'Hampir setiap hari'
        ],
        'thresholds' => [
            'minimal' => ['min' => 0, 'max' => 4],
            'mild' => ['min' => 5, 'max' => 9],
            'moderate' => ['min' => 10, 'max' => 14],
            'severe' => ['min' => 15, 'max' => 21]
        ],
        'recommendations' => [
            'minimal' => 'Tidak ada gejala kecemasan yang signifikan. Pertahankan keseimbangan hidup.',
            'mild' => 'Gejala kecemasan ringan. Pertimbangkan teknik relaksasi dan mindfulness.',
            'moderate' => 'Gejala kecemasan sedang. Disarankan untuk berkonsultasi dengan profesional kesehatan mental.',
            'severe' => 'Gejala kecemasan berat. Segera hubungi profesional kesehatan mental.'
        ]
    ],
    
    'dass-21' => [
        'name' => 'Depression Anxiety Stress Scale-21 (DASS-21)',
        'description' => 'Penilaian komprehensif untuk depresi, kecemasan, dan stres',
        'questions' => [
            'Saya merasa sulit untuk tenang',
            'Saya merasa mulut saya kering',
            'Saya tidak dapat merasakan perasaan positif sama sekali',
            'Saya mengalami kesulitan bernapas',
            'Saya merasa sulit untuk memulai melakukan sesuatu',
            'Saya cenderung bereaksi berlebihan terhadap situasi',
            'Saya mengalami tremor (gemetar)',
            'Saya merasa menggunakan banyak energi nervous',
            'Saya khawatir tentang situasi di mana saya mungkin panic dan mempermalukan diri sendiri',
            'Saya merasa tidak ada yang bisa ditunggu-tunggu',
            'Saya merasa gelisah',
            'Saya merasa sulit untuk rileks',
            'Saya merasa sedih dan tertekan',
            'Saya tidak sabar dengan apapun yang menunda saya dari apa yang saya lakukan',
            'Saya merasa seperti hampir panic',
            'Saya tidak dapat antusias tentang apapun',
            'Saya merasa tidak berharga sebagai seseorang',
            'Saya merasa agak mudah tersinggung',
            'Saya menyadari kerja jantung saya tanpa adanya physical exertion',
            'Saya merasa takut tanpa alasan yang baik',
            'Saya merasa hidup tidak berarti'
        ],
        'options' => [
            0 => 'Tidak berlaku untuk saya sama sekali',
            1 => 'Berlaku untuk saya sampai tingkat tertentu, atau kadang-kadang',
            2 => 'Berlaku untuk saya sampai tingkat yang cukup besar, atau sebagian besar waktu',
            3 => 'Sangat berlaku untuk saya, atau berlaku sepanjang waktu'
        ],
        'subscales' => [
            'depression' => [1, 3, 5, 10, 13, 16, 17, 21],
            'anxiety' => [2, 4, 7, 9, 15, 19, 20],
            'stress' => [6, 8, 11, 12, 14, 18]
        ],
        'thresholds' => [
            'depression' => [
                'normal' => ['min' => 0, 'max' => 4],
                'mild' => ['min' => 5, 'max' => 6],
                'moderate' => ['min' => 7, 'max' => 10],
                'severe' => ['min' => 11, 'max' => 13],
                'extremely_severe' => ['min' => 14, 'max' => 21]
            ],
            'anxiety' => [
                'normal' => ['min' => 0, 'max' => 3],
                'mild' => ['min' => 4, 'max' => 5],
                'moderate' => ['min' => 6, 'max' => 7],
                'severe' => ['min' => 8, 'max' => 9],
                'extremely_severe' => ['min' => 10, 'max' => 21]
            ],
            'stress' => [
                'normal' => ['min' => 0, 'max' => 7],
                'mild' => ['min' => 8, 'max' => 9],
                'moderate' => ['min' => 10, 'max' => 12],
                'severe' => ['min' => 13, 'max' => 16],
                'extremely_severe' => ['min' => 17, 'max' => 21]
            ]
        ],
        'recommendations' => [
            'normal' => 'Tingkat normal. Pertahankan keseimbangan hidup yang sehat.',
            'mild' => 'Tingkat ringan. Pertimbangkan strategi self-care dan manajemen stres.',
            'moderate' => 'Tingkat sedang. Disarankan untuk berkonsultasi dengan profesional.',
            'severe' => 'Tingkat parah. Sangat disarankan untuk segera mencari bantuan profesional.',
            'extremely_severe' => 'Tingkat sangat parah. Segera hubungi profesional kesehatan mental.'
        ]
    ]
];
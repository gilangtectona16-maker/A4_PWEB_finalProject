<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function landing() {
    $fitur = [
        ['ikon' => '🔐', 'judul' => 'Register & login',    'isi' => 'Buat akun, masuk, dan keluar kapan saja. Password disimpan dalam bentuk hash, bukan teks polos.'],
        ['ikon' => '📊', 'judul' => 'Dashboard progres',   'isi' => 'Pantau tugas yang selesai, jam ngoding, dan aktivitas terbaru dalam satu halaman.'],
        ['ikon' => '📝', 'judul' => 'Pengelolaan catatan', 'isi' => 'Simpan pelajaran, kesalahan, dan prestasi dalam kartu bergaya masonry yang rapi.'],
        ['ikon' => '🙋', 'judul' => 'Profil pribadi',      'isi' => 'Identitas, keahlian, dan pencapaian terkumpul di satu tempat.'],
    ];

    $langkah = [
        ['judul' => 'Daftar',        'isi' => 'Isi username, email, dan password. Cuma butuh satu menit.'],
        ['judul' => 'Masuk',         'isi' => 'Login dengan akun yang baru dibuat, lalu kamu langsung diarahkan ke dashboard.'],
        ['judul' => 'Mulai mencatat', 'isi' => 'Lihat progres, baca catatan, dan kenali dirimu lewat halaman profil.'],
    ];

    $teknologi = ['Laravel', 'Blade', 'Tailwind CSS', 'Vite'];

    return view('landingpage', compact('fitur', 'langkah', 'teknologi'));
}

    private function username(Request $request): string
    {
        return $request->query('username', session('user.username'));
    }

    public function dashboard(Request $request) {

        $tasks = [
            [
                'name' => 'Form register',
                'done' => true
            ],
            [
                'name' => 'Form login',
                'done' => true
            ],
            [
                'name' => 'Redirect ke dashboard',
                'done' => true
            ],
            [
                'name' => 'Dashboard mini',
                'done' => true
            ],
            [
                'name' => 'Halaman blog',
                'done' => true
            ],
        ];

        $activities = [
            [
                'time' => '9 November',   
                'text' => 'Selesai bikin blog nya',
            ],
            [
                'time' => '8 November',   
                'text' => 'Berhasil login ke dashboard'
            ],
            [
                'time' => '8 November',   
                'text' => 'Menemukan typo di nama layout, hampir pindah ke Django'
            ],
            [
                'time' => '8 November',   
                'text' => 'Menjalankan npm run dev untuk pertama kali'
            ],
            [
                'time' => '7 November',       
                'text' => 'Membuat form register'
            ],
            [
                'time' => '6 November',       
                'text' => 'Ada ide bikin UTS PWEB, tapi belum ada motivasi ngerjainnya'
            ],
            [
                'time' => '5 November',       
                'text' => 'Belum ada motivasi ngerjain pweb'
            ],
            [
                'time' => '4 November',       
                'text' => 'Belum ada motivasi ngerjain pweb'
            ],
            [
                'time' => '3 November',       
                'text' => 'Belum ada motivasi ngerjain pweb'
            ],
        ];

        $user = session('user');

        $codingHours    = 7;
        $debuggingHours = 8;

        $total   = count($tasks);
        $done    = collect($tasks)->where('done', true)->count();
        $percent = round($done / $total * 100);
        $lifetime = (int) config('session.lifetime');

        return view('dashboard', [
            'username'       => $this->username($request),
            'user' => $user, 
            'tasks' => $tasks, 
            'activities' => $activities, 
            'codingHours' => $codingHours, 
            'debuggingHours' => $debuggingHours, 
            'total' => $total, 
            'done' => $done, 
            'percent' => $percent, 
            'lifetime' => $lifetime
            ]);
    }

    public function pengelolaan(Request $request) {
        return view('pengelolaan', [
            'username' => $this->username($request),
            'user'    => session('user'),
            'catatan' => $this->dataCatatan(),
        ]);
    }

    public function profile(Request $request) {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $user = session('user');

        $bio = 'Mahasiswa yang lagi belajar Laravel dan Tailwind. Hobi: ngoding, main game, dan mencari typo yang bikin begadang.';

        $keahlian = [
            ['nama' => 'Laravel',        'level' => 40],
            ['nama' => 'Tailwind CSS',   'level' => 60],
            ['nama' => 'HTML & Blade',   'level' => 70],
            ['nama' => 'Debugging typo', 'level' => 95],
        ];

        $pencapaian = [
            ['ikon' => '🏆', 'judul' => 'Menang lomba KTI',          'tanggal' => '8 November 2026'],
            ['ikon' => '⭐', 'judul' => '9 bintang winstreak',        'tanggal' => 'Agustus 2026'],
            ['ikon' => '🚀', 'judul' => 'Selesai membuat blog UTS',   'tanggal' => '9 November 2026'],
        ];

        $semuaCatatan = $this->dataCatatan();

        $hari = 1;
        if (isset($user['created_at'])) {
            $hari = (int) abs(
                Carbon::parse($user['created_at'])->startOfDay()->diffInDays(now()->startOfDay())
            ) + 1;
        }

        return view('profile', [
            'username'       => $this->username($request),
            'user'           => $user,
            'bio'            => $bio,
            'keahlian'       => $keahlian,
            'pencapaian'     => $pencapaian,
            'catatanTerbaru' => array_slice($semuaCatatan, 0, 3),
            'totalCatatan'   => count($semuaCatatan),
            'hari'           => $hari,
        ]);
    }

    private function dataCatatan(): array {
        return [
            [
                'gambar'   => 'images/gambar_1.png',
                'durasi'   => '1 mnt',
                'kategori' => 'Stress kuliah',
                'judul'    => 'Jaga mentalmu lee~',
                'isi'      => [
                    'puhh, banyak banget tugas kuliah hari ini! udah proyek 5, UTS 2, ini otw 3 projek lainnya!',
                    'Duhh when yah punya doi yang bantu aku dalam susah maupun senang.',
                ],
                'tanggal'  => '1 November 2026',
            ],
            [
                'gambar'   => 'images/gambar_2.png',
                'durasi'   => '2 jam',
                'kategori' => 'Epep',
                'judul'    => 'Lumayan nyetok bundle ama senjata sih',
                'isi'      => [
                    'Aku harap tidak akan terjadi kehilangan akun pertamaku... (plis dah spend 5 juta ini)',
                ],
                'tanggal'  => 'Agustus 2026',
            ],
            [
                'gambar'   => 'images/gambar_3.png',
                'durasi'   => '9 mnt',
                'kategori' => 'ZZZ',
                'judul'    => 'Akhirnya 9 bintang winstreak dah tercapai!',
                'isi'      => [
                    'Aku harap tidak akan terjadi kehilangan akun pertamaku... ya meski sampah.',
                ],
                'tanggal'  => 'Agustus 2026',
            ],
            [
                'gambar'   => 'images/gambar_4.png',
                'durasi'   => '1 mnt',
                'kategori' => 'Laravel',
                'judul'    => 'ahh waktuku gendong project PWEB!',
                'isi'      => [
                    'Ngingetin aku pas lagi belum tahu kawin nya mikroba kek gimana. duh duh, kenapa di perkuliahan ngingetin aku ini lagi sih?! aku lupa klo orang Indonesia, bau jigongnya FOMO nya kuat banget.',
                ],
                'tanggal'  => '27 September 2026',
            ],
            [
                'gambar'   => 'images/gambar_5.png',
                'durasi'   => '1 mnt',
                'kategori' => 'Menang Lomba',
                'judul'    => 'Horeee menang lomba kti!',
                'isi'      => [
                    'Emang butuh perjuangan ni deh, tapi seneng juga. dengan mengikuti jejak bapak ku, sebagai laki laki tentu tidak akan lari.',
                    'Tapi tunggu, oh iya sertifikat ku!!.',
                ],
                'tanggal'  => '8 November 2026',
            ],
            [
                'gambar'   => 'images/gambar_6.png',
                'durasi'   => '5 mnt',
                'kategori' => 'AI Agent',
                'judul'    => 'Hermes ku butuh perbaikan...',
                'isi'      => [
                    'Emang butuh perjuangan ni deh, tapi juga seneng juga. yah yah, tinggal aku update in sama si aluber, pas jadinya keren deh.',
                    'Ku tunggu kolaborasi kita!',
                ],
                'tanggal'  => '9 November 2026',
            ],
        ];
        
    }
}
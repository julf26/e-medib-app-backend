<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aktivitas')->insert([
            [
                'nama_aktivitas' => "Jalan Santai (2,5-3,2 km/jam)",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Jalan biasa (<2,5 km/jam)",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Peregangan/yoga ringan(Hatha)",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Pilates",
                'met' => '3.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Memancing (berdiri)",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Memancing (duduk)",
                'met' => '2.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Billiard",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain lempar Tangkap",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktvitas rumah, bersih-bersih ringan (menyapu lantai/karpet, membersihkan jendela, mengepel, menyedot debu dengan vacuum cleaner)",
                'met' => '3.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas rumah, Menyetrika",
                'met' => '1.8',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas rumah, Menjahit",
                'met' => '2.8',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas rumah, Menyiram tanaman",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas rumah, Menyusui anak",
                'met' => '2.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas rumah, Mencuci mobil",
                'met' => '2.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas rumah, Kegiatan ringan di dapur ",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas di luar rumah, Berbelanja",
                'met' => '2.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Aktivitas di luar rumah, Mengendarai mobil",
                'met' => '2.8',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Istirahat, Tidur",
                'met' => '1.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Istirahat, Duduk sambil menonton televisi/merokok/membaca",
                'met' => '1.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain Kartu",
                'met' => '1.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Menggambar/Melukis/Menulis",
                'met' => '1.8',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Mengetik",
                'met' => '1.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain Alat Musik",
                'met' => '2.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain Alat Musik, Piano",
                'met' => '2.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain Alat Musik, Seruling",
                'met' => '2.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain Alat Musik, Trumpet",
                'met' => '1.8',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain Alat Musik, Biola",
                'met' => '2.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Bermain Alat Musik, Gitar",
                'met' => '2.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "RINGAN",

            ],
            [
                'nama_aktivitas' => "Memanah",
                'met' => '4.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Badminton (Non-kompetitif)",
                'met' => '5.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Bermain Basket (Non-kompetitif)",
                'met' => '6.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Bowling",
                'met' => '3.8',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Boxing(punching bag)",
                'met' => '5.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Golf(Walking)",
                'met' => '4.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Berkuda",
                'met' => '5.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Softball/Baseball",
                'met' => '5.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Volleyball",
                'met' => '6.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Tennis, doubles",
                'met' => '5.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Angkat Beban",
                'met' => '6.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Jalan Cepat (3,5 km/jam - 8 km/jam)",
                'met' => '5.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Berenang(tempo sedang)",
                'met' => '4.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Bersepeda Santai (8 km/jam)",
                'met' => '3.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Bersepeda (8 km/jam - 15 km/jam)",
                'met' => '5.8',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Yoga Power",
                'met' => '4',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Aktivitas rumah, bersih - bersih memindahkan barang",
                'met' => '5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Berkebun",
                'met' => '4.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Mengendarai Motor",
                'met' => '3.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Tenis Meja",
                'met' => '4.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "SEDANG"
            ],
            [
                'nama_aktivitas' => "Badminton (Kompetitif)",
                'met' => '7.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Bermain Basket",
                'met' => '7.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Football(kompetitif)",
                'met' => '8.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Ice Skating",
                'met' => '7.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Judo/Karate/Taekwondo",
                'met' => '10.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Berenang (tempo berat dengan gaya)",
                'met' => '10.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Aerobic (high impact)",
                'met' => '7.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Lompat Tali (Skipping)",
                'met' => '12.3',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Jogging (8 km/jam)",
                'met' => '8.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Jogging (9 km/jam - 13 km/jam)",
                'met' => '11.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Berlari (16 km/jam)",
                'met' => '14.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Berlari (10 km/jam - 15 km/jam)",
                'met' => '12.5',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ],
            [
                'nama_aktivitas' => "Bersepeda (16 km/jam - 20 km/jam)",
                'met' => '8.0',
                'durasi' => 0,
                'kalori' => 0,
                'tingkat_aktivitas' => "BERAT"
            ]
        ]);
    }
}

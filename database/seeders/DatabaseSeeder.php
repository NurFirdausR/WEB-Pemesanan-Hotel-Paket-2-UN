<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ReferralCode;
use App\Models\Fasilitas;
use App\Models\TipeKamar;
// use App\Models\Kamar;
use App\Models\Pendapatan;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@hotel.com',
                'role' => '0',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'Wahyudi',
                'email' => 'wahyudi@hotel.com',
                'role' => '1',
                'password' => bcrypt('password'),
            ],
        ];

            foreach ($user as $key => $value) {
                User::create($value);
            }
            
        $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123457890';
        $panj = 7;
        $txtl = strlen($text)-1;
        $koderef= '';
        for($i=1; $i<=$panj; $i++){
            $koderef .= $text[rand(0, $txtl)];
        }
        ReferralCode::create([
            'nama' => 'Akhir Tahun',
            'code' => $koderef,
            'disc' => 20,
            'masa_berlaku' => null
        ]);



         $Fasilitas = [
            [
                'nama_fasilitas' => 'Bathup',
                'keterangan' => 'bak mandi di setiap kamar',
                'gambar' => '20220324091531.jpeg',
                'tipe_fasilitas' => 'kamar'
            ],
            [
                'nama_fasilitas' => 'Gym',
                'keterangan' => 'buat olahraga',
                'gambar' => '20220323151521.png',
                'tipe_fasilitas' => 'kamar'
            ],
            [
                'nama_fasilitas' => 'Lapangan',
                'keterangan' => 'buat olahraga',
                'gambar' => '20220325144220.png',
                'tipe_fasilitas' => 'umum'
            ],
            [
                'nama_fasilitas' => 'Breakfast',
                'keterangan' => 'buat olahraga',
                'gambar' => '20220325144343.png',
                'tipe_fasilitas' => 'umum'
            ],
            [
                'nama_fasilitas' => 'Pool Area',
                'keterangan' => 'buat olahraga',
                'gambar' => '20220325144220.png',
                'tipe_fasilitas' => 'umum'
            ],
        ];
        foreach ($Fasilitas as $key => $val ) {
            Fasilitas::create($val);
        }


        $TipeKamar = [
            [
                'nama_tipe' => 'Deluxes',
                'keterangan' => 'Kamar deluxe kamar semi mewah di dengan ukuran 100m',
                'luas' => '100m',
            ],
            [
                'nama_tipe' => 'Premier',
                'keterangan' => 'Kamar premier kamar semi mewah di dengan ukuran 200m',
                'luas' => '200m',
            ]
        ];

        foreach ($TipeKamar as $key => $value) {
            TipeKamar::create($value);

        }
        Pendapatan::create([
            'total' => null
        ]);


            // $NamaKamar = [
            //     [
            //         'nama_kamar' => 'Single Bed',
            //         'no_kamar' => 'K01',
            //         'maks_orang' => '1',
            //         'fasilitas_id' => '1,2',
            //         'tipe_kamar_id' => '2',
            //         'status' => 'ubooked',
            //     ],
            //     [
            //         'nama_kamar' => 'Double Bed',
            //         'no_kamar' => 'K02',
            //         'maks_orang' => '2',
            //         'fasilitas_id' => '1',
            //         'tipe_kamar_id' => '1',
            //         'status' => 'ubooked',
            //     ],
            //     [
            //         'nama_kamar' => 'Junior Suite',
            //         'no_kamar' => 'K02',
            //         'maks_orang' => '2',
            //         'fasilitas_id' => '1',
            //         'tipe_kamar_id' => '1',
            //         'status' => 'ubooked',
            //     ],
            // ];

            // foreach ($NamaKamar as $key => $value) {
            //     Kamar::create($value);

            // }

    }
}

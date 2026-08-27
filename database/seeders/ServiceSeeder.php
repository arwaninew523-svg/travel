<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $defaultServices = [
            // INCLUDES (Fasilitas Termasuk)
            ['name' => 'Transportasi AC & Driver', 'type' => 'include'],
            ['name' => 'Tiket Masuk Objek Wisata', 'type' => 'include'],
            ['name' => 'Penginapan / Hotel Bintang 3', 'type' => 'include'],
            ['name' => 'Makan Sesuai Program (B/L/D)', 'type' => 'include'],
            ['name' => 'Tour Guide Profesional', 'type' => 'include'],
            ['name' => 'Dokumentasi Foto & Video', 'type' => 'include'],
            ['name' => 'Air Mineral Selama Tour', 'type' => 'include'],
            ['name' => 'Asuransi Perjalanan Wisata', 'type' => 'include'],

            // EXCLUDES (Fasilitas Tidak Termasuk)
            ['name' => 'Tiket Pesawat / Kereta Api PP', 'type' => 'exclude'],
            ['name' => 'Pengeluaran Pribadi (Belanja/Laundry)', 'type' => 'exclude'],
            ['name' => 'Tipping Driver & Tour Guide', 'type' => 'exclude'],
            ['name' => 'Obat-obatan Pribadi', 'type' => 'exclude'],
            ['name' => 'Wahana Permainan Opsional', 'type' => 'exclude'],
        ];

        foreach ($defaultServices as $service) {
            Service::create($service);
        }
    }
}

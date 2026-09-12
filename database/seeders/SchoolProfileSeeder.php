<?php

namespace Database\Seeders;

use App\Models\SchoolProfile;
use Illuminate\Database\Seeder;

class SchoolProfileSeeder extends Seeder
{
    public function run(): void
    {
        SchoolProfile::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'MI Darul Falah',
                'npsn' => '69881899',
                'nsm' => '111235150224',
                'status' => 'Swasta',
                'accreditation' => 'B',
                'established_year' => 2007,
                'address' => 'Bendomungal RT/RW 002/001, Sidorejo, Krian, Sidoarjo, Jawa Timur 61262',
                'whatsapp' => '082139808646',
                'email' => 'midarulfalahpusat@yahoo.com',
                'headmaster' => 'Drs. Ach. Azhari',
                'vision' => 'Berilmu, Berprestasi, Berakhlaqul Karimah',
                'extracurriculars' => ['Pramuka', 'Kaligrafi'],
                'facilities' => ['Ruang kelas', 'Laboratorium komputer'],
            ]
        );
    }
}

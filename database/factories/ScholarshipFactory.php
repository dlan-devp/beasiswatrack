<?php

namespace Database\Factories;

use App\Models\Scholarship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Scholarship>
 */
class ScholarshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $scholarships = [
            [
                'name' => 'Beasiswa Penuh S1 Teknik',
                'institution' => 'Universitas Indonesia',
                'description' => 'Beasiswa penuh untuk mahasiswa berprestasi di bidang teknik dengan GPA minimal 3.5',
                'requirements' => 'GPA minimal 3.5, Lulus ujian masuk, Surat rekomendasi dari guru, Essay motivasi',
                'type' => 'Penuh',
                'category' => 'S1',
                'application_link' => 'https://beasiswa.ui.ac.id/apply',
            ],
            [
                'name' => 'Beasiswa Sebagian S2 Manajemen',
                'institution' => 'Institut Teknologi Bandung',
                'description' => 'Beasiswa sebagian untuk mahasiswa S2 program manajemen dari seluruh Indonesia',
                'requirements' => 'S1 minimal IPK 3.0, TOEFL 500+, Surat motivasi, Wawancara',
                'type' => 'Sebagian',
                'category' => 'S2',
                'application_link' => 'https://beasiswa.itb.ac.id/s2-management',
            ],
            [
                'name' => 'Beasiswa Asean Mahasiswa Internasional',
                'institution' => 'Universitas Gadjah Mada',
                'description' => 'Program beasiswa untuk mahasiswa dari negara ASEAN lainnya di bidang Sains dan Teknologi',
                'requirements' => 'Warga negara negara ASEAN, GPA 3.2+, Proof of English proficiency',
                'type' => 'Penuh',
                'category' => 'S1',
                'application_link' => 'https://beasiswa.ugm.ac.id/asean',
            ],
            [
                'name' => 'Beasiswa Kinerja Akademik',
                'institution' => 'Universitas Diponegoro',
                'description' => 'Beasiswa untuk mahasiswa dengan prestasi akademik terbaik di semester sebelumnya',
                'requirements' => 'Mahasiswa aktif, IPK minimal 3.3, Tidak menerima beasiswa lain',
                'type' => 'Sebagian',
                'category' => 'S1',
                'application_link' => 'https://beasiswa.undip.ac.id/kinerja',
            ],
            [
                'name' => 'Beasiswa Pendidikan Seni dan Budaya',
                'institution' => 'Universitas Sebelas Maret',
                'description' => 'Beasiswa khusus untuk mahasiswa berprestasi di bidang seni dan budaya',
                'requirements' => 'Program studi seni/budaya, Portfolio karya, Prestasi di bidang seni',
                'type' => 'Penuh',
                'category' => 'S1',
                'application_link' => 'https://beasiswa.uns.ac.id/seni-budaya',
            ],
            [
                'name' => 'Beasiswa Penelitian S3 STEM',
                'institution' => 'Universitas Airlangga',
                'description' => 'Beasiswa untuk peneliti muda di bidang STEM yang ingin melanjutkan ke jenjang S3',
                'requirements' => 'S2 minimal IPK 3.5, Proposal penelitian, Rekomendasi dari pembimbing',
                'type' => 'Penuh',
                'category' => 'S3',
                'application_link' => 'https://beasiswa.unair.ac.id/s3-stem',
            ],
            [
                'name' => 'Beasiswa Keberlanjutan Lingkungan',
                'institution' => 'Universitas Andalas',
                'description' => 'Program beasiswa untuk mahasiswa yang fokus pada penelitian keberlanjutan lingkungan',
                'requirements' => 'Mahasiswa S1/S2 terkait lingkungan, GPA 3.2+, Proposal riset',
                'type' => 'Sebagian',
                'category' => 'S1',
                'application_link' => 'https://beasiswa.unand.ac.id/lingkungan',
            ],
            [
                'name' => 'Beasiswa Karir Global',
                'institution' => 'Universitas Padjadjaran',
                'description' => 'Beasiswa untuk mahasiswa yang ingin mengembangkan karir di tingkat global',
                'requirements' => 'TOEFL 550+, GPA minimal 3.3, Internship experience',
                'type' => 'Penuh',
                'category' => 'S1',
                'application_link' => 'https://beasiswa.unpad.ac.id/karir-global',
            ],
        ];

        $now = now();
        $scholarship = $this->faker->randomElement($scholarships);

        return [
            'name' => $scholarship['name'],
            'institution' => $scholarship['institution'],
            'description' => $scholarship['description'],
            'requirements' => $scholarship['requirements'],
            'type' => $scholarship['type'],
            'category' => $scholarship['category'],
            'application_link' => $scholarship['application_link'],
            'open_date' => $now->copy()->subDays(rand(1, 30)),
            'close_date' => $now->copy()->addDays(rand(30, 120)),
        ];
    }
}

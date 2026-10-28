<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    public function definition(): array
    {
        $jeniskelamin = fake()->randomElement(['L', 'P']);
        $gender = $jeniskelamin === 'L' ? 'male' : 'female';
        $angkatan = fake()->numberBetween(2022, 2025);
        $nama = fake()->firstName($gender) . ' ' . fake()->lastName();

        //
        $nim = substr((string) $angkatan, -2) . '0303'
             . fake()->unique()->numerify('####');

        return [
            'nim'           => $nim,
            'nama'          => $nama,
            'jenis_kelamin' => $jeniskelamin,
            'email'         => $nim . '@mhs.example.com',
            'angkatan'      => $angkatan,
            'program_studi' => 'D3 Teknik Informatika',
        ];
    }
}
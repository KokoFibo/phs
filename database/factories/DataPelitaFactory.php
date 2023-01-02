<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataPelita>
 */
class DataPelitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_umat' => fake()->name,
            'mandarin' => fake('zh_TW')->name, 
            'jenis_kelamin' => fake()->numberBetween(1,2), 
            'umur' => fake()->numberBetween(1,99),
            'umur_sekarang' => fake()->numberBetween(1,99),
            'alamat' => fake()->address,
            'kota_id' => fake()->numberBetween(1,5),
            'telp' => fake()->e164PhoneNumber(),
            'hp' => fake()->e164PhoneNumber(),
            'email' => fake()->email,
            'tgl_mohonTao' => fake()->dateTimeThisDecade(),
            'pengajak' => fake()->name,
            'penjamin' => fake()->name,
            'pandita_id' => fake()->numberBetween(1,3),
            'status' => 'Active',
            'branch_id' => fake()->numberBetween(1,3),
        ];
    }
}

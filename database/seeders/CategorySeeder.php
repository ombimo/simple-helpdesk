<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::query()->count() !== 0) {
            return;
        }

        foreach ($this->data() as $item) {
            Category::query()->create($item);
        }
    }

    public function data(): array
    {
        return [[
            'name'      => 'Permintaan Akses Sistem',
            'prefix_no' => 'PA',
        ], [
            'name'      => 'Reset Password',
            'prefix_no' => 'RP',
        ], [
            'name'      => 'Masalah Jaringan',
            'prefix_no' => 'NET',
        ], [
            'name'      => 'Kerusakan Perangkat Keras',
            'prefix_no' => 'HW',
        ], [
            'name'      => 'Permintaan Pengadaan',
            'prefix_no' => 'PO',
        ], [
            'name'      => 'Kesalahan Data / Input',
            'prefix_no' => 'DI',
        ], [
            'name'      => 'Bug Aplikasi',
            'prefix_no' => 'BUG',
        ], [
            'name'      => 'Pertanyaan Umum',
            'prefix_no' => 'GEN',
        ], [
            'name'      => 'Permintaan Training / Pelatihan',
            'prefix_no' => 'TRN',
        ], [
            'name'      => 'Permintaan Perubahan Sistem',
            'prefix_no' => 'SIS',
        ], [
            'name'      => 'Pengaduan Layanan',
            'prefix_no' => 'ADU',
        ], [
            'name'      => 'Kebutuhan Software',
            'prefix_no' => 'SW',
        ], [
            'name'      => 'Masalah Email',
            'prefix_no' => 'EM',
        ], [
            'name'      => 'Laporan Keamanan',
            'prefix_no' => 'SEC',
        ], [
            'name'      => 'Dokumentasi Tidak Lengkap',
            'prefix_no' => 'DOC',
        ], ];
    }
}

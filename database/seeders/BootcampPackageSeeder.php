<?php

namespace Database\Seeders;

use App\Models\BootcampPackage;
use Illuminate\Database\Seeder;

class BootcampPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BootcampPackage::create([
            'name' => 'Laravel Mastery v12',
            'slug' => 'laravel-mastery-v12',
            'description' => 'Belajar Laravel 12 dari nol hingga mahir. Termasuk API, Database, dan Deployment.',
            'price' => 500000.00,
            'batch_number' => 1,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(37),
            'is_active' => true,
        ]);

        BootcampPackage::create([
            'name' => 'Fullstack Laravel & React',
            'slug' => 'fullstack-laravel-react',
            'description' => 'Gabungkan kekuatan Laravel dan React JS untuk membangun aplikasi modern.',
            'price' => 750000.00,
            'batch_number' => 1,
            'start_date' => now()->addDays(14),
            'end_date' => now()->addDays(44),
            'is_active' => true,
        ]);
    }
}

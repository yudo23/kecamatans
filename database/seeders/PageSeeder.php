<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::firstOrCreate([
            'slug' => 'visi-misi'
        ],[
            'slug' => 'visi-misi',
            'name' => 'Visi Misi',
        ]);

        Page::firstOrCreate([
            'slug' => 'histories'
        ],[
            'slug' => 'histories',
            'name' => 'Sejarah',
        ]);

        Page::firstOrCreate([
            'slug' => 'service-hours'
        ],[
            'slug' => 'service-hours',
            'name' => 'Jam Buka Pelayanan',
        ]);
    }
}

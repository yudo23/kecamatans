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
        Page::updateOrCreate([
            'slug' => 'visi-misi'
        ],[
            'slug' => 'visi-misi',
            'name' => 'Visi Misi',
        ]);

        Page::updateOrCreate([
            'slug' => 'histories'
        ],[
            'slug' => 'histories',
            'name' => 'Sejarah',
        ]);
    }
}

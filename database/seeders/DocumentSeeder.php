<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            ['documentName' => 'resume', 'documentUrl' => 'document/resume.pdf'],
            ['documentName' => 'portfolio', 'documentUrl' => 'document/portfolio.pdf'],
        ]);
    }
}

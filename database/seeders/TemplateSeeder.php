<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::create([
            'name' => 'Uno'
        ]);
        Template::create([
            'name' => 'Dos'
        ]);
        Template::create([
            'name' => 'Tres'
        ]);
    }
}

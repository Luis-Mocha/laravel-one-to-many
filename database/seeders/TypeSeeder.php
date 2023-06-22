<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\Admin\Type;
//implemento laravel helper
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'FrontEnd',
            'Backend',
            'FullStack',
            'Design'
        ];

        foreach ($types as $elem) {
            //creo una nuova istanza
            $new_type = new Type();
            $new_type->name = $elem;
            $new_type->slug = Str::slug( $new_type->name);
            
            $new_type->save();
        }
    }
}

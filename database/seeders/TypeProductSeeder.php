<?php

namespace Database\Seeders;

use App\Models\TypeProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $items = [
            ['name' => 'Passeio de Barco'],
            ['name' => 'Passeio de Buggy'],
            ['name' => 'Passeio de Moto'],
        ];

        foreach($items as $item) {
            $type = new TypeProduct();
            $type->name = $item['name'];
            $type->status = true;
            $type->save();
        }
    }
}

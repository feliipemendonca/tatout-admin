<?php

namespace Database\Seeders;

use App\Models\TypePrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Criança de Colo'],
            ['name' => 'Criança até 11 anos e 11 meses'],
            ['name' => 'Adulto'],
            ['name' => 'Idoso'],
        ];

        foreach($items as $item) {
            $type = new TypePrice;
            $type->name = $item['name'];
            $type->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new App\Category();
        $category->name = 'Tecnologia';
        $category->save();
        
        $category2 = new App\Category();
        $category2->name = 'Esporte';
        $category2->save();
        
        $category3 = new App\Category();
        $category3->name = 'Comida';
        $category3->save();
    }
}

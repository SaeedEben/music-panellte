<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Music\Category();
        $translation = [
            'en' => 'happy',
            'fa' => 'شاد',
        ];
        $category->setTranslations('name' , $translation);
        $category->save();
    }
}

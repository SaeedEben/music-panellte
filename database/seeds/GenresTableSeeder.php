<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre = new \App\Models\Music\Genre();
        $translation = [
            'en' => 'rap',
            'fa' => 'رپ',
        ];
        $genre->setTranslations('name' , $translation);
        $genre->save();
    }
}

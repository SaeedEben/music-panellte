<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $album = new \App\Models\Music\Album();

        $translation = [
            'en' => 'world',
            'fa' => 'دنیا',
        ];

        $album->setTranslations('name' , $translation);

        $album->release_at = '2010-10-10';
        $album->number_of_track = '10';
        $album->save();

        $album->photos()->attach(1);
    }
}

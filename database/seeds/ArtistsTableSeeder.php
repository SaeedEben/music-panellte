<?php

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artist = new \App\Models\Music\Artist();

        $translation = [
            'en' => 'ebi',
            'fa' => 'ابی',
        ];

        $artist->setTranslations('name' , $translation);

        $artist->biography = 'ebrahim hamedi';
        $artist->save();

        $artist->photos()->attach(1);
    }
}

<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photo = new \App\Models\Music\Photo();
        $photo->image_path = 'storage/musics/The_Scream.jpg';
        $photo->save();
    }
}

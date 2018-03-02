<?php

use Illuminate\Database\Seeder;

class categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 1000; $i++) {
            $path = 'https://tv-v2.api-fetch.website/random/movie';
            $contents = json_decode(file_get_contents($path), true);
            $categories = Categories::all();

            foreach ($categories as $category) {
                $bam[] = strtolower($category['name']);
            }
            foreach ($contents['genres'] as $content) {
                if (in_array($content, $bam)) {

                }else{
                    $category = new Categories();
                    $category->name = ucfirst($content);
                    $category->description = 'Taip';
                    $category->user_id = 3;
                    $category->save();
                };


            }
        }
    }
}

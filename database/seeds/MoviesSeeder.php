<?php

use Illuminate\Database\Seeder;
use App\Categories;
use Illuminate\Support\Facades\Request;
use App\Movie;
use App\Actor;


class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($page = 7; $page < 8; $page++) {
            for ($y = 0; $y < 5; $y++) {
                $path = 'https://api.themoviedb.org/3/discover/movie?api_key=be98f6d22107b703991b078fdf1aeb9c&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=' . $page;
                $movies = json_decode(file_get_contents($path), true);


                $categories = 'https://api.themoviedb.org/3/genre/movie/list?api_key=be98f6d22107b703991b078fdf1aeb9c&language=en-US';
                $categories_id = json_decode(file_get_contents($categories), true);
                foreach ($categories_id['genres'] as $category_id) {
                    if ($category_id['id'] == $movies['results'][$y]['genre_ids'][0]) {
                        $category_name = $category_id['name'];
                    }
                }
                $category_id_db = Categories::where('name', $category_name)->get();

                if (!empty($category_id_db->first()->id)) {
                    $cat_id = $category_id_db->first()->id;
                } else {
                    $category = Categories::create([
                        'name' => $category_name,
                        'description' => 'Nauji',
                        'user_id' => 1,
                    ]);
                    $cat_id = $category->id;
                }


                $movie = Movie::create([
                    'name' => $movies['results'][$y]['title'],
                    'category_id' => $cat_id,
                    'user_id' => 1,
                    'description' => $movies['results'][$y]['overview'],
                    'year' => $movies['results'][$y]['release_date'],
                    'rating' => $movies['results'][$y]['vote_average'],
                ]);


                $file = file_get_contents('https://image.tmdb.org/t/p/original' . $movies['results'][$y]['poster_path']);
                $filename = basename('https://image.tmdb.org/t/p/original' . $movies['results'][$y]['poster_path']);
                Storage::put('public/image/' . $filename, $file);
                $movie->image()->create([
                    'filename' => $filename,
                    'user_id' => 1,
                ]);

                $file = file_get_contents('https://image.tmdb.org/t/p/original' . $movies['results'][$y]['backdrop_path']);
                $filename = basename('https://image.tmdb.org/t/p/original' . $movies['results'][$y]['backdrop_path']);
                Storage::put('public/image/' . $filename, $file);
                $movie->image()->create([
                    'filename' => $filename,
                    'user_id' => 1,
                ]);

                $casts = 'http://api.themoviedb.org/3/movie/'.$movies['results'][$y]['id'].'/casts?api_key=be98f6d22107b703991b078fdf1aeb9c';
                $casts_id = json_decode(file_get_contents($casts), true);
                for ($i = 0; $i < 5; $i++) {

                    $cast = 'https://api.themoviedb.org/3/person/' . $casts_id['cast'][$i]['id'] . '?api_key=be98f6d22107b703991b078fdf1aeb9c&language=en-US';
                    $cast_detale = json_decode(file_get_contents($cast), true);

                    if (!empty($cast_detale['birthday'])) {


                        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $cast_detale['birthday'], $parts)) {
                            // check whether the date is valid or not
                            if (checkdate($parts[2], $parts[3], $parts[1])) {
                                $birthday = $cast_detale['birthday'];
                            } else {
                                $birthday = $cast_detale['birthday'] . '-01-13';
                            }
                        } else {
                            $birthday = '1991-01-13';
                        }


                    } else {
                        $birthday = '1991-01-13';
                    }

                    if (!empty($cast_detale['deathday'])) {
                        $deathday = $cast_detale['deathday'];
                    } else {
                        $deathday = null;
                    }

                    $actor = Actor::create([
                        'name' => $cast_detale['name'],
                        'birthday' => $birthday,
                        'deathday' => $deathday,
                        'user_id' => 1,

                    ]);
                    $actor->movie()->attach($movie->id);
                    if (!empty($cast_detale['profile_path'])) {
                        $file = file_get_contents('https://image.tmdb.org/t/p/original/' . $cast_detale['profile_path']);
                        $filename = basename('https://image.tmdb.org/t/p/original/' . $cast_detale['profile_path']);
                        Storage::put('public/image/' . $filename, $file);
                        $actor->image()->create([
                            'filename' => $filename,
                            'user_id' => 1,
                        ]);
                    }

                }


            }

        }

    }
}

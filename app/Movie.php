<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Movie
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Actor[] $actor
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $user_id
 * @property string $description
 * @property int $year
 * @property float $rating
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereYear($value)
 */
class Movie extends Model
{
    protected $fillable = ['name', 'category_id', 'user_id', 'description', 'year', 'rating'];

    public function actor()
    {
        return $this->belongsToMany('App\Actor');
    }

    public function image()
    {
        return $this->morphMany('App\Image','imagable');
    }
    public function category()
    {
        return $this->belongsTo('App\Categories','category_id');
    }
    public function getFeatureImageAttribute()
    {
        if($this->image->first() == null){
            return 'http://tutaki.org.nz/wp-content/uploads/2016/04/no-image-available.png';
        }
        return asset('storage/image/' . $this->image->first()->filename);

    }
}

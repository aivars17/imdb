<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Actor
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Movie[] $movie
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $birthday
 * @property string|null $deathday
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereDeathday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereUserId($value)
 */
class Actor extends Model
{
    protected $fillable = ['name', 'birthday', 'deathday'];

    public function movie()
    {
        return $this->belongsToMany('App\Movie');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function image()
    {
        return $this->morphMany('App\Image','imagable');
    }
    public function getFeatureImageAttribute()
    {
        if($this->image->first() == null){
         return 'http://tutaki.org.nz/wp-content/uploads/2016/04/no-image-available.png';
        }
         return asset('storage/image/' . $this->image->first()->filename);

    }

}

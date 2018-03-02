<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Categories
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereUserId($value)
 */
class Categories extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'user_id'];

    public function movies()
    {
        return $this->hasMany('App\Movie','category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'image',
        'category_id'];

    public function comments(){
        return $this->hasMany(comment::class);
    }

    public function likes(){
        return $this->hasMany(like::class);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    //    polymorphic Relations//
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}

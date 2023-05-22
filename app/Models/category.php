<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['title','parent_id'];

    public function usersWhoseInterest(){
        return $this->belongsToMany(user::class,'user_interests','category_id','user_id');
    }

    public function subCategories(){
        return $this->hasMany(category::class,'parent_id');
    }
    public function parentCategory(){
        return $this->belongsTo(category::class,'parent_id');
    }
    public function posts(){
        return $this->hasMany(post::class);
    }
}

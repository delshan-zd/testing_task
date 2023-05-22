<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class comment extends Model
{
    use HasFactory;
    protected $fillable = ['text','user_id','post_id'];

    public function post(){
        return $this->belongsTo(post::class);
    }
    public function user(){
        return $this->belongsTo(user::class);
    }

}

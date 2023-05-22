<?php

namespace App\Http\Livewire;

use App\Models\like;
use App\Models\post;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikePost extends Component
{
    public int $postId;
    public bool $liked;

public  function mount()
   {
     $this->liked=post::find($this->postId)->likes->contains(auth()->user()->getAuthIdentifier());
   }
public function like(){
    if(auth()->check()){
        if($this->liked){
            post::find($this->postId)->likes()->where('user_id',auth()->user()->getAuthIdentifier())->delete();
        }
        else{
            post::find($this->postId)->likes()->create(['user_id'=>auth()->user()->getAuthIdentifier()]);
        }
        $this->liked= !$this->liked;

    }
}

    public function render()
    {
     return view('livewire.like-post');
    }

}

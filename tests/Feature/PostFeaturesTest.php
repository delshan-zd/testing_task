<?php

namespace Tests\Feature;

use App\Models\category;
use App\Models\Image;
use App\Models\like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;
use Tests\TestCase;
//use Faker\Generator;
use App\Models\post;


class postFeaturesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    
        $response->assertStatus(200);
    }

    public function test_store_post_related_to_user()
    {
        $user=User::factory()->create();

        $data=[
            'title'=>'test_title',
            'body'=>fake()->text(),
            'category_id'=>null,
            'image'=>fake()->imageUrl()
            ];

     $response = $this->actingAs($user)->post('/posts/store',$data);
              if(User::find($user->id) == null){
                  $this->assertDatabaseHas('posts',[
                      'title'=>'test_title',
                      'user_id'=>$user->id,
                  ]);
              }
              else{
                  $this->assertDatabaseMissing('posts',[
                      'title'=>'test_title',
                      'user_id'=>$user->id,
                  ]);
              }
    }

    public function test_store_comment_on_post()
    {
        $user=User::factory()->create();
        $comment_info=[
            'comment'=>'test_comment',
        ];
        $data=[ 'post_id'=>fake()->numberBetween(1,post::count()),
            'user_id'=>$user->id
        ];

        $response = $this->actingAs($user)->post('/makecomment/'.$data['post_id'],[$comment_info,$data['post_id']]);


        if (  post::where('id',$data['post_id']) == null or User::where('id',$data['user_id'] == null)){
            $this->assertDatabaseMissing('comments',[
                'user_id'=>$data['user_id'],
                'post_id'=>$data['post_id'],
                'text'=>'test_comment'
            ]);
        }
        else{
            $this->assertDatabaseHas('comments',[
                'user_id'=>$data['user_id'],
                'post_id'=>$data['post_id'],
                'text'=>'test_comment'
            ]);
        }
    }
//
 public function test_store_like_on_post()
    {
        $user=User::factory()->create();
        $data=[
            'post_id'=>fake()->numberBetween(1, Post::count()),
            'user_id'=>$user->id
        ];
        $response = $this->actingAs($user)->get('/addLike/'.$data['post_id']);

        if ( post::find($data['post_id']) == null ){

            $this->assertDatabaseMissing('likes',[
               'user_id'=>$data['user_id'],
               'post_id'=>$data['post_id'],
           ]);
        }
        else{
            if(! like::where('user_id',$data['user_id'])->where('post_id',$data['post_id'])->exists())
            {
                $response->assertStatus(200);
            }
            elseif( like::where('user_id',$data['user_id'])->where('post_id',$data['post_id'])->exists()) {
              $this->assertDatabaseHas('likes',[
                  'user_id'=>$data['user_id'],
                  'post_id'=>$data['post_id']
              ]);

            }
        }
    }
   
   
      
   



}


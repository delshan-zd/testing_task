<?php

namespace Tests\Feature;

use App\Models\category;
use App\Models\post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class categoryFeaturesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function select_parent_id(){
        return fake()->numberBetween(1, category::count());
    }
    public function select_category(){
        return fake()->numberBetween(1, category::count());
    }
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_store_category()
    {
        $data=[
            'title'=>'category_test_title',
            'parent_id'=>fake()->numberBetween(1, category::count()),
        ];
        $user=User::factory()->create();

        $selected_category=category::find($data['parent_id']);
        while ($selected_category == null){
            $data['parent_id']=$this->select_parent_id();
            $selected_category=category::find($data['parent_id']);
        }

        $response = $this->actingAs($user)->post('/categories/'.$selected_category,$data);

             $this->assertDatabaseHas('categories',[
                'title'=>'category_test_title',
                'parent_id'=>$data['parent_id'],
            ]);

    }


    public function test_store_category_by_UnAuthenticated_user()
    {

        $data=[
            'title'=>'category_test_title',
            'parent_id'=>fake()->numberBetween(1, category::count()),
        ];

        $response = $this->post('/categories/'.$data['parent_id'],$data);

          $this->assertGuest();

    }


    public function test_delete_category()
    {
        $data=[
            'id'=>fake()->numberBetween(1, category::count()),
        ];
        $selected_category=category::find($data['id']);
        $user=User::factory()->create();
        $response = $this->actingAs($user)->delete('/categories/'.$data['id']);

        if ($selected_category != null and category::where('parent_id',$selected_category->id)->first() == null){
            $this->assertDatabaseMissing('categories',[
                'id'=>$data['id']
            ]);
        }
        elseif($selected_category != null and category::where('parent_id',$selected_category->id)->first() != null){
            $this->assertDatabaseHas('categories',[
                'id'=>$data['id']
            ]);
        }
        elseif($selected_category == null){// the category is not exist in the DB
            $this->assertDatabaseMissing('categories',[
                'id'=>$data['id']
            ]);
        }

    }



    public function test_add_new_subCategory_to_existing_category()
    {
        $data=[
            'new_subcategory'=>'subcategory_test_title',
            'parent_id'=>fake()->numberBetween(1, category::count())
        ];


        $selected_parent_category=category::find($data['parent_id']);
        if($selected_parent_category != null){$data['parent_id']=$data['parent_id']; }
        while ($selected_parent_category == null){
            $data['parent_id']=$this->select_parent_id();
            $selected_parent_category=category::find($data['parent_id']);

        }

        $user=User::factory()->create();
        $response=$this->actingAs($user)->post('/addSubcategory/'.$data['parent_id'],$data);

                $this->assertDatabaseHas('categories',[
                    'parent_id'=>$data['parent_id'],
                    'title'=>'subcategory_test_title'
                ]);

    }


}

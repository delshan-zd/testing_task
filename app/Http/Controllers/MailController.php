<?php

namespace App\Http\Controllers;

use App\Mail\RealMailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
//i was testing the route
//    public function index(){
//        return response()->json('dddd');
//    }
    public function index(){
        $data=[
            'subject'=>'Good Morning ',
            'body'=>'vfv .fd; v.fdccfsdffddvfddv'
        ];
        try {
            Mail::to('delshano.399@gmail.com')->send(new RealMailNotify($data));
            return response()->json('email has been sent _ check your inbox');
        } catch (\Exception $t){
            return response()->json('something get wrong');
        }

    }

}

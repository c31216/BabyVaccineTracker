<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Immunization;
use App\Post;
use App\Vaccine;
use App\User;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
         
        $vaccine = Vaccine::all();
       
        return view('sms.index')->withVaccines($vaccine);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter(Request $request){

        // $posts = Post::join('immunizations', 'immunizations.p_id', '=', 'posts.id')
        //     ->select(max(['immunizations.p_id']),'posts.*')
        //     ->where('vaccine_id', '!=' , $request->vaccine_id)
        //     ->groupBy('p_id')
        //     ->get();
        $vaccine_id = $request->vaccine_id;

        $users = Post::whereDoesntHave('users', function($q) use($vaccine_id){
            $q->where('vaccine_id', '=', $vaccine_id);
        })->get();

        if ($users->isEmpty()) {
            echo "";
            
        }else{    

            foreach ($users as $user) {
            echo "<input type='checkbox' class='users' checked name='".$user->id."' value='".$user->id."'> " . $user->pat_lname . ", " . $user->pat_fname . " <br>";
            }
        }

       
        
        // foreach ($posts as $post) {
        //    echo "<p>" . $post->pat_lname . ", " . $post->pat_fname . "</p>";
        // }

    }
}

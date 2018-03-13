<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Database\QueryException;

class userController extends Controller
{
    public function __construct(User $user){
      $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
          $data = $this->user->get();
        } catch (QueryException $e) {
          return response()->json(['error' => "it screwed up"], 404);
        }

        if(count($data)>0){
          return response()->json($data);
        }return response()->json(['error' => 'Nothing found'], 404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $newStuff = [
        "name" => $request->name,
        "email" => $request->email,
        "password" => $request->password
      ];

      try{
        $this->user->create($newStuff);
      }
      catch(QueryException $a){
        return response()->json(["Error" => "something missing"], 404);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $data = $this->user->where("id",$id)->get();
      } catch (QueryException $e) {
        return response()->json(['error' => "it screwed up"], 404);
      }

      if(count($data)>0){
        return response()->json($data);
      }return response()->json(['error' => 'Nothing found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $newStuff = [
        "name" => $request->name,
        "email" => $request->email,
        "password" => $request->password
      ];
      $pt = $request->id;

      try{
        $this->user->where('id',$pt)->update($newStuff);
      }
      catch(QueryException $a){
        return response()->json(["Error" => "not found"], 404);
      }

      if($data = 1){
        return response()->json(["updated"],200);
      }
      else{
        return response()->json(["Error" => "not found"], 404);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try{
        $data = $this->user->where("id",$id)->delete();
      }
      catch(QueryException $a){
        return response()->json(["Error" => "not found"], 404);
      }

      if($data == 1){
        return response()->json(["deleted"],200);
      }
      else{
        return response()->json(["Error" => "not found"], 404);
      }
    }
}

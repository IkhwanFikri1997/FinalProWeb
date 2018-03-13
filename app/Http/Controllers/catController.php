<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;

class catController extends Controller
{
  public function __construct(Category $category){
    $this->category = $category;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $data = $this->category->get();
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
        "name" => $request->name
      ];

      try{
        $data = $this->category->create($newStuff);
        return response()->json($data);
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
        $data = $this->category->where("id",$id)->get();
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
        "name" => $request->name
      ];
      $pt = $request->id;

      try{
        $this->category->where('id',$pt)->update($newStuff);
      }
      catch(QueryException $a){
        return response()->json(["Error" => "not found"], 404);
      }

      if($data == 1){
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
        $data = $this->category->where("id",$id)->delete();
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Database\QueryException;

class itemController extends Controller
{
    public function __construct(Item $item){
      $this->item = $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $data = $this->item->get();
        $array = Array();
        $array['data'] = $data;
      } catch (QueryException $e) {
        return response()->json(['error' => "it screwed up"], 404);
      }

      if(count($data)>0){
        return response()->json($array);
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
        "category_id" => $request->category_id,
        "name" => $request->name,
        "desc" => $request->desc,
        "price" => $request->price,
        "stock" => $request->stock
      ];

      try{
        $data = $this->item->create($newStuff);
        return response()->json($data);
      }
      catch(QueryException $a){
        return response()->json(["Error" => "it screwed up"], 404);
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
        $data = $this->item->where("id",$id)->get();
      } catch (QueryException $e) {
        return response()->json(['error' => "it screwed up"], 404);
      }

      if(count($data)>0){
        return response()->json($data);
      }return response()->json(['error' => 'Nothing found'], 404);
    }

    public function search($q)
    {
      $search = '%'.$q.'%';
      try {
        $data = $this->item->where("name","like",$search)->get();
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
    public function update($id, Request $request)
    {/*
      $newStuff = [
        "category_id" => $request->category_id,
        "name" => $request->name,
        "desc" => $request->desc,
        "price" => $request->price,
        "stock" => $request->stock
      ];*/

      if(isset($request->category_id)) $newStuff ["category_id"] = $request->category_id;
      if(isset($request->name)) $newStuff["name"] = $request->name;
      if(isset($request->desc)) $newStuff["desc"] = $request->desc;
      if(isset($request->price)) $newStuff["price"] = $request->price;
      if(isset($request->stock)) $newStuff["stock"] = $request->stock;

      $pt = $id;

      try{
        $data = $this->item->where("id",$pt)->update($newStuff);
        //return response()->json($data);
      }
      catch(QueryException $a){
        return response()->json(["Error" => $a], 404);
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
        $data = $this->item->where("id",$id)->delete();
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

    function itemByCat($id){
        try{
          $data = Category::with('items')->where('id', $id)->get();
        }catch (QueryException $a){
            return response()->json(["Error" => "not found"], 404);
        }

        if(count($data) > 0){
            return response()->json($data);
        }else{
            return response()->json(["Error" => "not found"], 404);
        }
    }
}

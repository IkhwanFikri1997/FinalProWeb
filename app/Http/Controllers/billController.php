<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Database\QueryException;

class billController extends Controller
{
    public function __construct(Bill $bill){
      $this->bill = $bill;
      //$this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $data = $this->bill->get();
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
        "customer_id" => $request->customer_id
      ];

      try{
        $data['data'] = $this->bill->create($newStuff);
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
        $data = $this->bill->where("id",$id)->get();
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
    public function update(Request $request, $id)
    {
      $newStuff = [
        "customer_id" => $request->customer_id
      ];

      try{
        $this->bill->where('id',$id)->update($newStuff);
      }
      catch(QueryException $a){
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
        $data = $this->bill->where("id",$id)->delete();
      }
      catch(QueryException $a){
        return response()->json(["Error" => "not found"], 404);
      }
    }

    public function print($id){
      try{
        $data = array();
        $data['data'] = Bill::with('buyer','translist')->where('id', $id)->get();
      }catch (QueryException $a){
          return response()->json(["Error" => $a], 404);
      }

      if(count($data) > 0){
          return response()->json($data);
      }else{
          return response()->json(["Error" => "not found"], 404);
      }
    }
}

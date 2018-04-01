<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Item;
use App\User;
use Illuminate\Database\QueryException;

class transController extends Controller
{
  public function __construct(Transaction $transaction){
    $this->transaction = $transaction;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $data['data'] = $this->transaction->get();
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

      $stk = Item::select('stock')->where('id',$request->item_id)->get();
      $s=0;
      foreach ($stk as $key => $value) {
        $s = $value["stock"];
      }
      if($request->qty > $s){
        return response()->json(["Error" => "not enough stock"], 404);
      }

      try{
        $prc = Item::select('price')->where('id',$request->item_id)->get();
        $p=0;
        foreach ($prc as $key => $value) {
          $p = $value["price"];
        }
        $res = $request->qty * $p;

        $newStuff = [
          "customer_id" => $request->customer_id,
          "item_id" => $request->item_id,
          "qty" => $request->qty,
          "total" => $res
        ];

        $data['data'] = $this->transaction->create($newStuff);
        return response()->json($data);
      }
      catch(QueryException $a){
        return response()->json(["Error" => $a], 404);
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
        $data['data'] = $this->transaction->where("id",$id)->get();
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
    public function update($id,Request $request)
    {
      $newStuff = [
        "customer_id" => $request->customer_id,
        "item_id" => $request->item_id,
        "qty" => $request->qty,
        "total_price" => $request->total_price
      ];

      try{
        $data = $this->transaction->where('id',$id)->update($newStuff);
        //response()->json($data);
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
        $data = $this->transaction->where("id",$id)->delete();
      }
      catch(QueryException $a){
        return response()->json(["Error" => "screwed up"], 404);
      }

      if($data == 1){
        return response()->json(["deleted"],200);
      }
      else{
        return response()->json(["Error" => "not found"], 404);
      }
    }

    public function subtotal($cust_id, $item_id)
    {
      try {
        $conditions = ['customer_id'=>$cust_id , 'item_id'=>$item_id];
        $data['data'] = Transaction::with('customersrc','itemsrc')->where($conditions)->get();
      } catch (QueryException $e) {
        return response()->json(['error' => "it screwed up"], 404);
      }

      if(count($data)>0){
        return response()->json($data);
      }return response()->json(['error' => 'Nothing found'], 404);
    }

    public function printBill($cust_id)
    {
      try {
        $conditions = ['customer_id'=>$cust_id];
        $data['data'] = Transaction::with('customersrc','itemsrc')->where($conditions)->get();
      } catch (QueryException $e) {
        return response()->json(['error' => "it screwed up"], 404);
      }

      if(count($data)>0){
        return response()->json($data);
      }return response()->json(['error' => 'Nothing found'], 404);
    }
}

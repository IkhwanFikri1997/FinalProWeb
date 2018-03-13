<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $table="transactions";
  protected $fillable=["customer_id","item_id","qty","total"];
  protected $guarded=[];

  //declare relations to perhaps get item name and price
  public function itemsrc(){
    return $this->belongsTo("App\Models\Item","item_id");
  }
  public function customersrc(){
    return $this->belongsTo("App\User","customer_id");
  }
}

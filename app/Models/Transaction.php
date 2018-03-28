<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Uuid;

class Transaction extends Model
{
  public $incrementing = false;

  protected static function boot()
  {
      parent::boot();
      static::creating(function ($model) {
          $model->id = (string)Uuid::generate();
      });
  }

  protected $table="transactions";
  protected $fillable=["bill_id","item_id","qty","total"];
  protected $guarded=[];

  //declare relations to perhaps get item name and price
  public function itemsrc(){
    return $this->belongsTo("App\Models\Item","item_id");
  }
  public function billsrc(){
    return $this->belongsTo("App\Models\Bill","bill_id");
  }
}

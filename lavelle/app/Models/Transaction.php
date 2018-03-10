<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $table="transactions";
  protected $fillable=["category_id","customer_id","item_id","qty","total_price"];
  protected $guarded=[];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Item extends Model
{
  protected $table="items";
  protected $fillable=["category_id","name","price","stock"];
  protected $guarded=[];

  public function cats(){
    return $this->belongsTo("App\Models\Category", "category_id");
  }
}

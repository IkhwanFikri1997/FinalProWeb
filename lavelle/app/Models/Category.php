<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Category extends Model
{
  protected $table="categories";
  protected $fillable=["name"];
  protected $guarded=[];

  public function cats(){
    return $this->hasMany("Apps\Model\Item");
  }
}

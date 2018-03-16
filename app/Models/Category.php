<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use Uuid;

class Category extends Model
{
  public $incrementing = false;

  protected static function boot()
  {
      parent::boot();
      static::creating(function ($model) {
          $model->id = (string)Uuid::generate();
      });
  }

  protected $table="categories";
  protected $fillable=["name"];
  protected $guarded=[];

  public function cats(){
    return $this->hasMany("App\Models\Item");
  }
}

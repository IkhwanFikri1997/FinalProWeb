<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Uuid;

class Item extends Model
{
  public $incrementing = false;

  protected static function boot()
  {
      parent::boot();
      static::creating(function ($model) {
          $model->id = (string)Uuid::generate();
      });
  }

  protected $table="items";
  protected $fillable=["category_id","name","desc","price","stock"];
  protected $guarded=[];

  public function cats(){
    return $this->belongsTo("App\Models\Category", "category_id");
  }

  public function trans(){
    return $this->hasMany("App\Models\Transaction");
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Uuid;

class Bill extends Model
{
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string)Uuid::generate();
        });
    }

    protected $table = "bills";
    protected $fillable=["customer_id"];

    public function buyer(){
      return $this->belongsTo("App\User","customer_id");
    }

    public function translist(){
      return $this->hasMany("App\Models\Transaction");
    }
}

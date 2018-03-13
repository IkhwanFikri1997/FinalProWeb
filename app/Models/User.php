<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table="items";
  protected $fillable=["name","email","password"];
  protected $guarded=[];
}

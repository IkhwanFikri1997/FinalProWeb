<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table="users";
  protected $fillable=["name","email","password"];
  protected $guarded=[];

  public function trans(){
    return $this->hasMany("Apps\Models\Transaction");
  }
}

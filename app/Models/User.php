<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table="users";
  protected $fillable=["name","email","password", 'phone_num', 'address',];
  protected $guarded=[];
  protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at', 'admin'];

  public function trans(){
    return $this->hasMany("Apps\Models\Transaction");
  }
}

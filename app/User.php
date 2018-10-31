<?php
namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use SoftDeletes, HasRoles, Notifiable;
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */



  protected $dates = ['deleted_at','created_at', 'updated_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'email', 'password', 'status', 'hidden'
  ];
  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
      'password', 'remember_token',
  ];



  public function setPasswordAttribute($password)
  {
      $this->attributes['password'] = bcrypt($password);
  }


}

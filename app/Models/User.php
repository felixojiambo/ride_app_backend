<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    //mass assignable for below code
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

protected $guarded=[];

    protected $hidden = [
        'login_code',
        'remember_token',
    ];
public function routeNotificationForTwilio()
{
    return $this->phone;
}
public function driver()
{
    return $this->hasOne(Driver::class);
}
public function trips(){
    return $this->hasMany(Trip::class);
}
}

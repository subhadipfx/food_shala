<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isRestaurant(){
        return $this->role == 'restaurant';
    }
    public function isCustomer(){
        return $this->role == 'customer';
    }

    public function details(){
        if($this->isCustomer()){
            return $this->hasOne(Customer::class,'email','email')->first();
        }else if($this->isRestaurant()){
            return $this->hasOne(Restaurant::class,'email','email')->first();
        }
        return null;
    }
}

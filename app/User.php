<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'gender', 'phone', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role'
    ];

    public function role($role) {     
        if ($role == $this->role) return true;
        
        return false; 
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id')->orderBy('created_at', 'DESC');
    }

    public function wished()
    {
        return $this->hasMany(WishList::class, 'user_id');
    }

    public function address()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return empty($this->contract_id);
    }

    public function isContractAdmin()
    {
        return ($this->contract_id!==null && $this->role == 2);
    }

    public function isParentUser()
    {
        return ($this->contract_id!==null && $this->role == 3);
    }

    public function isDependentUser()
    {
        return ($this->contract_id!==null && $this->role == 4);
    }

}

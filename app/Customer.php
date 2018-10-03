<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
    protected $table = 'customer';

    protected $fillable = ['username','fullname','email','password','sex','mobile','address','province_id','avatar'];

    public $timestamps = false;
}

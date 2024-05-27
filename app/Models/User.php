<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;

class User extends Authenticatable implements LdapAuthenticatable
{
    use  AuthenticatesWithLdap;

    protected $fillable = [
        'user_name', 'password', 'role',
    ];

    protected $hidden = [
        'password',
    ];

}

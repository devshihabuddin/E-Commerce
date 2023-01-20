<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Seller extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $guard='sellers';
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'address',
        'photo',
        'phone',
        'is_verified',
        'status'
    ];
}

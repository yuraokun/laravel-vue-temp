<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
use Illuminate\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, MustVerifyEmail, Billable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function sendEmailVerificationNotification()
    {

        $this->notify(new VerifyEmail("user"));
    }



}